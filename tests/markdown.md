# Business层方法

[TOC]

## 购物车


### 获取指定会话中的购物车
```
/**
 * @param string $sessionId 会话id
 * @return array
 */
CartBusiness::getCartsInfo($sessionId)

return:
[
   'carts' => [
        CartEntity,
        CartEntity,
        ...
        CartEntity,
    ],
    originPrice => Price,
    totalPrice => Price
]
//依赖接口
ProductBusiness::getProductsByIds($productIds);
```

### 添加产品到购物车

```
/**
 * @param ProductEntity $product 产品实体
 * @param int $quantity 产品数量
 * @param array $attrs 产品属性组合
 * @return int
 */
CartBusiness::addToCart(ProductEntity $product, $quantity, $attrs);

//属性组合数据案例
$attrs = [
    [
        'attr_id' => 227,
        'attr_value_id' => 27713
    ]
];

return $cartId

//依赖的方法：
ProductEntity::getStock() //获取当前产品真实库存
ProductEntity::isOnsale() //当前产品是否在售
```

### 修改购物车
```
/**
 * @param int $cartId 购物车id
 * @param array $data 更新的数据
 * @return boolean
 */
CartBusiness::modifyCartById($cartId, array $data);

//目前$data只能修改quantity

return true|false
```

### 移除购物车
```
/**
 * @param int $cartId 购物车id
 * @return boolean
 */
CartBusiness::removeCartById($cartId)
return true|false
```

### CartEntity提供的方法

```
/**
 * 判断当前cart item是否可以购买
 * @return boolean
 */
CartEntity::isPurchable();

/**
 * 获取当前产品的属性描述
 * @return array
 */
CartEntity::getProductAttrs();

return [
   [
       attr_id => 227,
       attr_name => 'Size',
       attr_value_id => 227130,
       attr_value => 'XS'
   ],
   ...
];
```


## Checkout

### 获取配送方式
```
/**
 * 获取支持指定国家的所有运输方式
 * @param int $countryId 国家id
 * @return ShippingMethodEntity[]
 */
ShippingMethodBusiness::getShippingMethods($countryId);

return
[
    ShippingMethodEntity,
    ShippingMethodEntity,
    ...
    ShippingMethodEntity,
]
```
### 计算指定配送方式的运费

```
/**
 * @param ShippingMethod $shippingMethod 指定的运输方式
 * @param CartEntity[] $carts 购物车条目
 */
ShippingMethodBusiness::calculateShippingPrice(ShippingMethod $shippingMethod, array $carts);

return Price
```


### ShippingMethodEntity提供的方法
```
/**
 * 获取当前配送方式类型
 * stand_shipping express_shipping Expedited_shipping
 * @return int
 */
ShippingMethodEntity::getType()

```


### 获取支付渠道
```
/**
 * 获取支持的支付方式
 * @return PaymentEntity[]
 */
PaymentBusiness::getPayments();

return
[
   PaymentEntity,
   PaymentEntity,
   ...
   PaymentEntity
]
```

### 获取下单辅助数据
```
/**
 * @param int $phone 用户手机号
 */
OrderBusiness::getSupplementaryData($phone)

return
[
    'isFirstOrder' => true,
    'avaliablePoints' => 122,
    'isSupportCod' => true
];

//依赖外部方法
PointBusiness::getMemberAvaliablePoints($memberId); //获取用户可用积分
OrderBusiness::getMemberOrderNum($memberId); //获取用户订单总数
OrderBusiness::isSupportCod($phone);
```


### 获取用户订单总数
```
/**
 * @param int $memberId 会员id
 * @return int
 */
OrderBusiness::getMemberOrderNum($memberId);
```

### 计算价格
```
/**
 * @param int $addressId 地址id
 * @param int $shippingMethodId 运输方式id
 * @param int $paymentId 支付方式id
 * @param int $points 使用的积分数量
 * @param string $coupon 使用的优惠券
 * @param boolean $useInsurance 是否购买运费险
 * @param boolean $useWallet 是否使用钱包
 */
OrderBusiness::getCheckoutPrices($addressId, $shippingMethodId, $paymentId, $points, $coupon, $useInsurance, $useWallet);

return [
    originPrice => Price,
    totalPrice => Price,
    shippingPrice => Price,
    insurancePrice => Price,
    walletPrice => Price
    discount => "30%|-30",
    codPrice => Price,
    rewardPoints => 12,
    shippingPrices => [
        express_shipping => Price,
        stand_shipping => Price,
        expedited_shipping => Price
    ],
    insurance => Price,
    wallet => [
        totalPrice => Price,
        subtractPrice => Price
    ]
];

//依赖的外部方法
PointBusiness::getExchangePrice($points); //获取积分可抵用的价格
CouponBusiness::getCoupon($couponCode);
CouponEntity::isValid(); //当前优惠券是否有效
ShippingMethodBusiness::calculateShippingPrice(ShippingMethod $shippingMethod);
```

### 生成订单
```
/**
 * @param int $addressId 地址id
 * @param int $shippingMethodId 运输方式id
 * @param int $paymentId 支付方式id
 * @param int $points 使用的积分数量
 * @param string $coupon 使用的优惠券
 * @param boolean $useInsurance 是否购买运费险
 * @param boolean $useWallet 是否使用钱包
 */
OrderBusiness::place($addressId, $shippingMethodId, $paymentId, $points, $coupon, $useInsurance, $useWallet, $comment);

return OrderEntity;

//依赖的外部方法
OrderBusiness::getCheckoutPrices()
```
## Order

### 获取用户订单
```
/**
 * 获取用户订单
 * @param int $memberId 用户id
 * @param int $offset 偏移量
 * @param int $limit 限制取多少条
 * @return OrderEntity[]
 */
OrderBusiness::getMemberOrders($memberId, $offset, $limit);
```

### 获取订单详情
```
/**
 * @param string $billno 订单号
 * @return OrderEntity
 */
OrderBusiness::getOrderByBillno($billno);
```

### 修改订单

```
/**
 * @param string $billno 订单号
 * @param array $data 修正的数据
 * @return boolean
 */
OrderBusiness::updateOrderByBillno($billno, array $data)
```

### 取消订单
```
/**
 *
 * @param string $billno
 * @return boolean
 */
OrderBusiness::cancelOrder($billno);

//依赖的方法
PointBusiness::addPoints($memberId, $points); //增加积分
PointBusiness::updateCouponByCode(); 修改优惠券
```

### 完成订单
```
/**
 *
 * @param string $billno
 * @return boolean
 */
OrderBusiness::completeOrder($billno);

//依赖的方法
PointBusiness::getExchangePoints($total); //价格转换积分
PointBusiness::addPoints($memberId, $points); //增加积分
```

### COD取消订单
```
/**
 *
 * @param string $billno
 * @return boolean
 */
OrderBusiness::revokeOrder($billno);

//依赖的方法
PointBusiness::addPoints($memberId, $points); //增加积分
PointBusiness::updateCouponByCode(); 修改优惠券
```

### OrderEntity提供的方法

```
/**
 * 当前订单有没有被支付
 * @return boolean
 */
OrderEntity::isPaid();

/**
 * 当前订单有没有完成
 * @return boolean
 */
OrderEntity::isComplete();

/**
 * 获取订单状态
 * @return int
 */
OrderEntity::getStatus();

//订单状态计算依赖OrderGoods，所以构造OrderEntity时需要传递对应的OrderGoods，否则不予计算
```

### OrderGoodsEntity提供的方法
```
/**
 * 获取当前产品的状态
 * @param int
 */
OrderGoodsEntity::getStatus();

/**
 * 是否已经发货
 * @param boolean
 */
OrderGoodsEntity::isShipped();
```

## Token支付

### 获取用户token
```
/**
 * @param int $memberId 用户id
 * @param int $offset 偏移量
 * @param int $limit 数量
 * @param true|null $valid 是否只查有效的
 * @param PaymentToken[]
 */
PaymentTokenBusiness::getMemberPaymentTokens($memberId, $offset, $limit, $valid = null)
```

### 删除Token
```
/**
 * @param int $memberId 用户id
 * @param int $tokenId token id
 * @return boolean
 */
PaymentTokenBusiness::delete($memberId, $tokenId)
```

## COD


### 发送短信

```
/**
 * @param string $phone 手机号
 * @param string $message 消息内容
 * @return boolean
 */
SmsBusiness::send($phone, $message);
```

### 验证订单
```
/**
 * @param string $code 验证码
 * @param string $billno 订单号
 * @return boolean
 */
CodBusiness::verifyCode($code, $billno);
```

### Token支付
```
/**
 * @param string $billno 订单号
 * @param int $paymentTokenId token id
 * @return boolean
 */
WorldpayBusiness::tokenPay($billno, $paymentTokenId)

```

### 信用卡支付

```
/**
 * @param string $billno 订单号
 * @param int $paymentId 支付卡种类的唯一编号
 * @param array $cardData 用户的卡信息
 * @param boolean $rememberCard 是否记住卡号
 * @return boolean
 */
WorldpayBusiness::pay($billno, $paymentId, $cardData, $rememberCard = true)
//普通支付结果
retur [
    'action' => 'direct',
    'result' => true
];
//3d支付结果
return [
    'action' => 'render',
    'data' => [
        'foo' => 'xxx',
        'bar' => 'xxx',
        'baz' => 'xxx'
    ]
];
```

### 3D支付回调
```
/**
 * @param string $billno 订单号
 * @param string $paResponse 银行认证之后返回给客户端的参数
 * @return boolean
 */
WorldpayBusiness::securePayCallback($billno, $paResponse);
```

### 本地支付
```
/**
 * @param string $billno 订单号
 * @param int $paymentId 支付卡种类的唯一编号
 */
WorldpayBusiness::localPay($billno, $paymentId);
//失败的情况
return [
    'action' => 'direct',
    'result' => false
];
//成功的情况
return [
    'action' => 'redirect',
    'url' => 'http://sofort.com/payment'
];
```

### 本地支付成功回调

```
/**
 * @param string $billno 订单号
 * @param string $paymentStatus 第三方支付机构之后返回给客户端的参数
 * @param string $orderKey 第三方支付机构之之后返回给客户端的参数
 * @return boolean
 */
WorldpayBusiness::localPayCallback($billno, $paymentStatus, $orderKey);
```

## PayPal

### Paypal支付请求
```
/**
 * @param string $billno订单号
 * @param string $returnUrl 确认完成之后url
 * @param string $cancelUrl 取消支付返回的url
 */
PayPalBusiness::pay($billno, $returnUrl, $cancelUrl);

//成功
return [
    'action' => 'redirect',
    'url' => 'http://paypal.com/payment'
]

//失败
return [
    'action' => 'direct',
    'result' => false
]


```

### PayPal支付回调
```
/**
 * @param string $billno 订单号
 * @param string $token paypal返回参数
 * @param string $playerId paypal返回参数
 * @return boolean
 */
PayPalBusiness::callback($billno, $token, $payerID);
```