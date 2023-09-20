<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReplyFilter extends ApiFilter
{
    // Todo: type filter and status filter need to be check again.

    protected $safeParams = [
        'guestId' => ['eq'],
        'messageId' => ['eq'],
        'description' => ['eq'],
        'type' => ['eq'],
        'status' => ['eq'],
    ];

    protected $columnMap = [
        'guestId' => 'guest_id',
        'messageId' => 'message_id',
    ];

    /**
     * Transforms the given request into an array of Eloquent query conditions.
     *
     * @param Request $request The HTTP request object.
     * @return array The array of Eloquent query conditions.
     */
    public function transform(Request $request): array
    {
        // Initialize an empty array to store the Eloquent query conditions
        $eloQuery = [];

        // Iterate through each safe parameter and its corresponding operators
        foreach ($this->safeParams as $param => $operators) {

            // Get the query value for the current parameter
            $query = $request->query($param);

            // If the query value is empty, skip to the next parameter
            if (!$query) {
                continue;
            }

            // Assign the column name for the current parameter
            // If the column name is not found in the column map, use the parameter name as the column name
            $column = $this->columnMap[$param] ?? $param;

            // Iterate through each operator for the current parameter
            foreach ($operators as $operator) {
                // Check if the query has the current operator
                if (isset($query[$operator])) {

                    // Apply specific transformations for type and status parameters
                    if ($param == "type") {
                        $query[$operator] = $this->findTypeId($query[$operator]);
                    } elseif ($param == "status") {
                        $query[$operator] = $this->findStatusId($query[$operator]);
                    }

                    // Add the query condition to the Eloquent query array
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        // Return the array of Eloquent query conditions
        return $eloQuery;
    }

    /**
     * Finds the type ID based on the query operator.
     *
     * @param string $queryOperator The query operator to check.
     * @return int The type ID.
     */
    protected function findTypeId(string $queryOperator): int
    {
         // ["0": "call", "1": "email"]
        return Str::of($queryOperator)->lower() == "call" ? 0 : (Str::of($queryOperator)->lower() == "email" ? 1 : 2);
    }

    /**
     * Finds the status ID based on the query operator.
     *
     * @param string $queryOperator The query operator to check.
     * @return int The status ID.
     */
    protected function findStatusId($queryOperator): int
    {
        // ["0": "pending", "1": "done", "2": "cancle"]
        switch (Str::of($queryOperator)->lower()) {
            case 'pending':
                return 0;
                break;
            case 'done':
                return 1;
                break;
            case 'cancle':
                return 2;
                break;
            default:
                return 3;
                break;
        }
    }
}
