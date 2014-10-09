<?php

class Version extends Eloquent {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'version';
    
    public function upgradeVersion(){
        $version = Version::where('id', '=', 1);
        $version->version = $version->version++;
        $version->save();
    }
    
    public function downgradeVersion(){
        $version = Version::where('id', '=', 1);
        $version->version = $version->version--;
        $version->save();
    }
    
}