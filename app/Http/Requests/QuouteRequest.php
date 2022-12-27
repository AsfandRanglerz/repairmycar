<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuouteRequest extends FormRequest
{
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
                'car_images' => 'required',
                'document' => 'required',
                'looking_for' => 'required',
                'model' => 'required',
                'company_id' => 'required',
                'model_year_id' => 'required',
                'mileage' => 'required',
                'day' => 'required',
                'maker_name' => 'required',
                'address' => 'required',
                'registration_no' => 'required',
                'Chasis_no' => 'required',
                'color' => 'required',
            ];
       
        // return [
        //     'files' => 'required',
        //         'category' => 'required',
        //         'car_images' => 'required',
        //         'looking_for' => 'required',
        //         'model' => 'required',
        //         'company_id' => 'required',
        //         'model_year_id' => 'required',
        //         'mileage' => 'required',
        //         'day' => 'required',
        //         'maker_name' => 'required',
        //         'address' => 'required',
        //         'registration_no' => 'required',
        //         'Chasis_no' => 'required',
        //         'color' => 'required',
        //         'document' => 'required',
        // ];
        }
}
