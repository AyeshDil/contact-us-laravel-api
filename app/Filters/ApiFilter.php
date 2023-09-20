<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',

    ];

    public function transform(Request $request): array
    {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            // dd($query);
            // print_r($query); // [eq] => 0

            if(!$query){
                continue;
            }

            // Assign value to the $colomn variable. if the $this->columnMap[$param] value is null assign $param value to the variable
            $column = $this->columnMap[$param] ?? $param; 

            foreach ($operators as $operator) {
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }

        }
        // die;
        // dd($eloQuery);
        return $eloQuery;
    }
}