<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends User
{
    use \Tightenco\Parental\HasParent;

}
