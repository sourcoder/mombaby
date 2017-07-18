<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\WechatUser;
/**
 * WechatController implements the CRUD actions for Food model.
 */
class WechatController extends Controller
{
    /**
     * 我的信息菜单入口
     */
    public function actionUser()
    {
        
        $code = $_GET["code"];
        if($code == '2')
        {
            $redirect_uri = Yii::$app->params['wechat']['redirect_uri'];
            $redirect_uri = urlencode($redirect_uri);
            $appid = Yii::$app->params['wechat']['appid'];
            $appsecret = Yii::$app->params['wechat']['appsecret'];
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
            $this->redirect($url);//重定向后得到code
        }else
        {
            $state = $_GET["state"];
            $access_token = $this->getAccesstoken($code, $state);
            //检验授权凭证（access_token）是否有效
            $data = $this->checkAvail($access_token['access_token'],$access_token['openid']);
            if($data['errcode'] != '0' || $data['errmsg'] != 'ok')
            {
                //刷新access_token
                $access_token = $this->refresh_access_token($access_token['refresh_token']);
            }
            //得到拉取用户信息(需scope为 snsapi_userinfo)
            $userinfo = $this->get_user_info($access_token['access_token'],$access_token['openid']);
            //require 'view/index.html';//-------1------这里根据具体情况去修改
            /**************************************************/
   /*       //测试输出    
            var_dump($userinfo);
            echo "昵称:".$userinfo['nickname'];
            echo "<br/>";
            echo "性别:".$userinfo['sex']; echo "<br/>";
            echo "国家:".$userinfo['country']; echo "<br/>";
            echo "省份:".$userinfo['province']; echo "<br/>";
            echo "城市:".$userinfo['city']; echo "<br/>";
            echo "----------头像--------------" ;echo "<br/>";
            echo  '<img src="'.$userinfo['headimgurl'].'" />'; 
            echo 'hahha';
            */
            $openid = $userinfo['openid'];
            //检查用户是否已经存在于数据表中 
            $user_check = WechatUser::find()->where(['openid'=>$openid])->one();
            if ($user_check) 
            {
                /*-------wechat User 表中的数据---------*/
                //更新用户资料
                $user_check->nickname = $userinfo['nickname'];
                $user_check->sex = $userinfo['sex'];
                $user_check->headimgurl = $userinfo['headimgurl'];
                $user_check->country = $userinfo['country'];
                $user_check->province = $userinfo['province'];
                $user_check->city = $userinfo['city'];
                $user_check->access_token = $access_token['access_token'];
                $user_check->refresh_token = $access_token['refresh_token'];
                $user_check->update();
                $id = $user_check->id;
            } 
            else 
            {
                /*-------wechat User 表中的数据---------*/
                //保存用户资料
                $user = new WechatUser();
                $user->nickname = $userinfo['nickname'];
                $user->sex = $userinfo['sex'];
                $user->headimgurl = $userinfo['headimgurl'];
                $user->country = $userinfo['country'];
                $user->province = $userinfo['province'];
                $user->city = $userinfo['city'];
                $user->access_token = $access_token['access_token'];
                $user->refresh_token = $access_token['refresh_token'];
                $user->openid = $openid;
                $user->created_at = time();
                $user->save();            
                $id = $user->id;
            }
            $this->redirect(["person/info", 'id' => $id]);
        }
    }
    /**
     * 推荐菜谱的入口
     */
    public function actionRecipe()
    {
        $code = $_GET["code"];
        if($code == '2')
        {
            $redirect_uri = "http://www.sdorms.com/wechat/recipe?code=2";
            $redirect_uri = urlencode($redirect_uri);
            $appid = Yii::$app->params['wechat']['appid'];
            $appsecret = Yii::$app->params['wechat']['appsecret'];
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
            $this->redirect($url);//重定向后得到code
        }else
        {
            $state = $_GET["state"];
            $access_token = $this->getAccesstoken($code, $state);
            //检验授权凭证（access_token）是否有效
            $data = $this->checkAvail($access_token['access_token'],$access_token['openid']);
            if($data['errcode'] != '0' || $data['errmsg'] != 'ok')
            {
                //刷新access_token
                $access_token = $this->refresh_access_token($access_token['refresh_token']);
            }
            //得到拉取用户信息(需scope为 snsapi_userinfo)
            $userinfo = $this->get_user_info($access_token['access_token'],$access_token['openid']);
            $openid = $userinfo['openid'];
            //检查用户是否已经存在于数据表中
            $user_check = WechatUser::find()->where(['openid'=>$openid])->one();
            if ($user_check)
            {
                /*-------wechat User 表中的数据---------*/
                //更新用户资料
                $user_check->nickname = $userinfo['nickname'];
                $user_check->sex = $userinfo['sex'];
                $user_check->headimgurl = $userinfo['headimgurl'];
                $user_check->country = $userinfo['country'];
                $user_check->province = $userinfo['province'];
                $user_check->city = $userinfo['city'];
                $user_check->access_token = $access_token['access_token'];
                $user_check->refresh_token = $access_token['refresh_token'];
                $user_check->update();
                $id = $user_check->id;
            }
            else
            {
                /*-------wechat User 表中的数据---------*/
                //保存用户资料
                $user = new WechatUser();
                $user->nickname = $userinfo['nickname'];
                $user->sex = $userinfo['sex'];
                $user->headimgurl = $userinfo['headimgurl'];
                $user->country = $userinfo['country'];
                $user->province = $userinfo['province'];
                $user->city = $userinfo['city'];
                $user->access_token = $access_token['access_token'];
                $user->refresh_token = $access_token['refresh_token'];
                $user->openid = $openid;
                $user->created_at = time();
                $user->save();
                $id = $user->id;
            }
            if($user_check && $user_check->current_week)
            {
                $this->redirect(['person/index', 'id' => $id]);
            }else {
                $this->redirect(['person/info', 'id' => $id]);
            }
        
        }
    }
    
   
    /*
     * 第二步：由code得到access_token
     */
    public function getAccesstoken($code, $state) 
    {
        $appid = Yii::$app->params['wechat']['appid'];
        $appsecret = Yii::$app->params['wechat']['appsecret'];
        $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $access_token = $this->https_request($request_url);
        $arr = json_decode($access_token,true);
        return $arr;
    }
    /*
     *
     *  刷新access_token（如果需要）
     *
     * */
    private function refresh_access_token($refresh_token)
    {
        //三步：刷新access_token（如果需要）
        $refresh_url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$this->appid."&grant_type=refresh_token&refresh_token={$refresh_token}";
        $access_token = $this->https_request($refresh_url);
        return json_decode($access_token,true);
    }
    
    public function https_request($url,$data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data))
        {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        if(curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
        curl_close($curl);
        return $output;
    }
    /**
     *检验授权凭证（access_token）是否有效
     * @param string $access_token
     * @param string $open_id
     **/
    private function checkAvail($access_token='',$openid='')
    {
        if($access_token && $openid)
        {
            $avail_url = "https://api.weixin.qq.com/sns/auth?access_token={$access_token}&openid={$openid}";
            $avail_data = $this->https_request($avail_url);
            return json_decode($avail_data, TRUE);
        }
        return FALSE;
    }
    /**
     * 获取授权后的微信用户信息
     *oauth2.0
     * @param string $access_token
     * @param string $open_id
     **/
    public function get_user_info($access_token = '', $open_id = '')
    {
        // 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        if($access_token && $open_id)
        {
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
            $info_data = $this->https_request($info_url);
            return json_decode($info_data, TRUE);
        }
        return FALSE;
    }
}
