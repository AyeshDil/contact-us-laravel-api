<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class GuestFilter extends ApiFilter
{
    protected $safeParams = [
        'firstName' => ['eq'],
        'lastName' => ['eq'],
        'email' => ['eq'],
        'contactNumber' => ['eq'],
        'messages' => ['eq']
    ];

    protected $columnMap = [
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'contactNumber' => 'contact_number'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',

    ];

    // public function transform(Request $request): array
    // {
    //     $eloQuery = [];

    //     foreach ($this->safeParams as $param => $operators) {
    //         $query = $request->query($param);
    //         // dd($query);

    //         if(!$query){
    //             continue;
    //         }

    //         // Assign value to the $colomn variable. if the $this->columnMap[$param] value is null assign $param value to the variable
    //         $column = $this->columnMap[$param] ?? $param; 

    //         foreach ($operators as $operator) {
    //             if(isset($query[$operator])){
    //                 $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
    //             }
    //         }

    //     }
    //     // dd($request);
    //     return $eloQuery;
    // }
}
