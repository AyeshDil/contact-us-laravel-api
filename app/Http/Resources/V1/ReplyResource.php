<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->created_at->toTimeString());
        // $status = $this->status 
        return [
            'replyId' => $this->id,
            'userId' => $this->user_id,
            'messageId' => $this->message_id,
            'description' => $this->description,
            'type' => $this->getTypeName($this->type),
            'status' => $this->getStatusName($this->status),
            'repliedDate' => $this->created_at->toDateString(),
            'repliedTime' => $this->created_at->toTimeString()
        ];
    }

    protected function getStatusName($statusNumber){
        // ["0": "pending", "1": "done", "2": "cancle"]
        return $statusNumber==0 ? "Pending" : ($statusNumber==1 ? "Done" : "Cancle");
    }

    protected function getTypeName($typeNumber):string{
        // ["0": "call", "1": "email"]
        return $typeNumber==0 ? "call" : "email";
    }
}
