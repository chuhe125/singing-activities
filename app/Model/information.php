<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class information extends Model
{
    protected $table = "information";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    //更新作曲人
    public static function updateQv($id, $name1, $contact1, $identityCard1)
    {
        try {
            $res = self::where('enroll_id', $id)
                ->update([
                    'name' => $name1,
                    'contact'=> $contact1,
                    'identity_card'=> $identityCard1
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    //更新作词人
    public static function updateCi($id, $name3, $contact3, $identityCard3)
    {
        try {
            $res = self::where('enroll_id', $id)
                ->update([
                    'name' => $name3,
                    'contact'=> $contact3,
                    'identity_card'=> $identityCard3
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    //更新负责人
    public static function updateFz($id, $name2, $contact2, $identityCard2)
    {
        try {
            $res = self::where('enroll_id', $id)
                ->update([
                    'name' => $name2,
                    'contact'=> $contact2,
                    'identity_card'=> $identityCard2
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

}
