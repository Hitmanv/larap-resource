# 一个 restful 资源生成工具

# 使用方法

## STEP-1:
```bash
    composer require hitman/resource --dev
```

## STEP-2:
修改**config/app.php**, service providers 添加
```php
Hitman\Resource\ResourceServiceProvider::class,
```

## STEP-3:
### 生成数据库字典
```bash
php artisan resource:doc
```

### 生成资源对应的文件
生成资源对应的 model/admin-controller/admin-api-controller/view/route

```bash
php artisan resource:make
```