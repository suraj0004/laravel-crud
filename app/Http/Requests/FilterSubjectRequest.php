<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterSubjectRequest extends FormRequest
{
    private $columns = array(
        0 => 'id',
        1 => 'name',
        2 => 'title',
        3 => 'description',
        4 => 'options',
    );

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function getOrderColumn()
    {
        return $this->columns[$this->input('order.0.column')];
    }

    public function getDir()
    {
        return $this->input('order.0.dir');
    }
}
