<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    
    protected $fillable =  [ 'dni_doc','nom_doc','ape_doc','instt_docp','cobt_doc', 'especialidad_id','tipogrado_id','reparto_id','tiposangre_id','fnac_doc','lnac_doc'];

  //Relacion Uno a Uno
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
  public function reparto() {

    return $this->belongsTo(Reparto::class,'reparto_id');
}

//Relacion Uno a Uno
public function tiposangre() {

    return $this->belongsTo(Tiposangre::class,'tiposangre_id');
}

 //Relacion Uno a Uno
 public function especialidad() {

    return $this->belongsTo(Especialidad::class,'especialidad_id');
}

//Relacion Uno a Uno
public function tipogrado() {

    return $this->belongsTo(Tipogrado::class,'tipogrado_id');
}

//Relacion uno a Muchos
public function asignadoc() {
    
    return $this->hasMany('App\Models\Asignadoc');
}

//Relacion uno a Muchos
public function planevaa() {
    
    return $this->hasMany('App\Models\Planeva');
}

public function scopeFiltername($query, $name) {

if(!empty($name)) {
    return $query->where('nom_doc', 'like', "%$name%");
}

}

public function scopeFilterapel($query, $apel) {

if(!empty($apel)) {
    return $query->orwhere('ape_doc', "$apel");
}

}

public function scopeFilterdni($query, $dni) {
        
if(!empty($dni)) {
    return $query->orWhere('dni_doc', "$dni");

}

}

}
