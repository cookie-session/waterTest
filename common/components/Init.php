<?php

namespace common\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\UnauthorizedHttpException;
use common\models\member\Member;
use common\helpers\StringHelper;
use common\enums\AppEnum;

/**
 * Class InitConfig
 * @package common\components
 * @author jianyan74 <751393839@qq.com>
 */
class Init implements BootstrapInterface
{
    /**
     * 应用ID
     *
     * @var
     */
    protected $id;

    /**
     * @param \yii\base\Application $application
     * @throws UnauthorizedHttpException
     * @throws \Exception
     */
    public function bootstrap($application)
    {
        Yii::$app->params['uuid'] = StringHelper::uuid('uniqid');

        $this->id = $application->id;// 初始化变量
        // 商户信息
        if (in_array(Yii::$app->id, [AppEnum::CONSOLE, AppEnum::BACKEND])) {
            $this->afreshLoad('');
        } elseif (in_array(Yii::$app->id, [AppEnum::MERCHANT, AppEnum::OAUTH2])) {
            /** @var Member $identity */
            $identity = Yii::$app->user->identity;
            $this->afreshLoad($identity->merchant_id ?? '');
        } else {
            $merchant_id = Yii::$app->request->headers->get('merchant-id', '');
            if (empty($merchant_id)) {
                $merchant_id = Yii::$app->request->get('merchant_id', '');
            }

            $this->afreshLoad($merchant_id);
        }
    }

    /**
     * @param $merchant_id
     * @throws UnauthorizedHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function afreshLoad($merchant_id)
    {
        try {
            Yii::$app->services->merchant->setId($merchant_id);
            // 初始化模块
            Yii::$app->setModules($this->getModulesByAddons());
        } catch (\Exception $e) {

        }
    }

    /**
     * 获取模块
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function getModulesByAddons()
    {
        $addons = Yii::$app->services->addons->findCacheAllNames();

        $modules = [];
        $merchant = AppEnum::MERCHANT;
        foreach ($addons as $addon) {
            $name = $addon['name'];
            $app_id = $this->id;
            // 模块映射
            if ($this->id == AppEnum::BACKEND && $addon['is_merchant_route_map'] == true) {
                $app_id = $merchant;
            }

            $modules[StringHelper::toUnderScore($name)] = [
                'class' => 'common\components\BaseAddonModule',
                'name' => $name,
                'app_id' => $app_id,
            ];

            // 初始化服务
            if (!empty($addon['service'])) {
                // 动态注入服务
                Yii::$app->set(lcfirst($name) . 'Service', [
                    'class' => $addon['service'],
                ]);
            }
        }

        return $modules;
    }
}
