<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * Store address and return its id
     *
     * @param  array $data
     * @return int
     */
    public function store(array $data)
    {
        //validation rules
        // $rules = [
        //     'title' => 'required|string|unique:todos,title|min:2|max:191',
        //     'body'  => 'required|string|min:5|max:1000',
        // ];
        // //custom validation error messages
        // $messages = [
        //     'title.unique' => 'Todo title should be unique', //syntax: field_name.rule
        // ];
        //First Validate the form data
        // $request->validate($rules, $messages);

        // $this = new Address;

        $this->line_1 = $data["line_1"];
        // $this->line_2 = $data["line_2"];
        // $this->line_3 = $data["line_3"];
        $this->county_province = $data["county_province"];
        $this->region = $data["region"];
        $this->zip_postal_code = $data["zip_postal_code"];
        $this->country = $data["country"];

        $this->save();

        return $this->id;
    }
}
