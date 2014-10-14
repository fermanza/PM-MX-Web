<?php

class Version extends Eloquent {

    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'version';
    
    public static function upgradeVersion(){
        $version = Version::where('id', '=', 1)->first();
        $version->version += 1;
        $version->save();
    }
    
    public static function downgradeVersion(){
        $version = Version::where('id', '=', 1);
        $version->version -= 1;
        $version->save();
    }
    
}