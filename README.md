# Laravel Jsonponse

This Laravel package to response JSON message using in RESTful API.


### \# Installation

1. use `composer` install this package

        $ composer require jasechen/laravel-jsonponse

2. edit `config/app.php`

        $ joe config/app.php

        # add
        #
        'providers' => [
            ...
            Jasechen\Jsonponse\JsonponseServiceProvider::class,
            ...
        ],

3. reload and update packages

        $ composer dump-autoload


### \# Usage

in `app/Http/Controllers/SampleController.php`, for example

    use Jasechen\Jsonponse\Jsonponse;
    ...

    public function printSuccessMessage()
    {
        Jsonponse::success('find success', ['session' => '83cec640fda431a66c293b12a4fa4a83']);
    } // END function

    public function printErrorMessage()
    {
        Jsonponse::fail('input params error', 400);
    } // END function

Result

    # printSuccessMessage
    #
    {
        "status": "success",
        "code": 200,
        "comment": "find success",
        "data": {
            "session": "83cec640fda431a66c293b12a4fa4a83"
        }
    }

    # printErrorMessage
    #
    {
        "status": "fail",
        "code": 400,
        "comment": "input params error"
    }


### \# HTTP Status Code with RESTful API

#### \# 2xx - SUCCESS 成功

| Code | Description                 | Note                                                                      | RESTful API                              |
|:-----|:----------------------------|:--------------------------------------------------------------------------|:-----------------------------------------|
| 200  | OK<br> 成功                 | 請求已經成功，並且**有返回內容**                                          | 刪除 / 讀取成功                          |
| 201  | Created<br> 已建立          | 請求成功，而且在伺服器上**新建了一個資源** (如：新增文章、留言)           | 新增 / 更新 成功                         |
| 202  | Accepted<br> 已接受         | 伺服器接受了一個請求，但伺服器可能**沒辦法馬上完成** (如：需要排程的工作) | 產生檔案                                 |
| 204  | No Content<br> 成功但無回傳 | 請求成功，但是**沒有任何回傳內容** (真的沒有回傳任何東西)                 | 所有條件規則驗證都符合，但就是沒資料可撈 |

#### \# 4xx - CLIENT ERROR 用戶端錯誤

| Code | Description               | Note                                                                  | RESTful API                       |
|:-----|:--------------------------|:----------------------------------------------------------------------|:----------------------------------|
| 400  | Bad Request<br> 錯誤請求  | 請求中有些資料的**內容不正確**而無法被解讀 (表單驗證錯誤並不是這個)   |                                   |
| 401  | Unauthorized<br> 需要登入 | 使用者**必須登入**才能執行這個動作                                    | 需要登入才能執行，卻沒有登入      |
| 403  | Forbidden<br> 沒有權限    | **沒有權限**可以存取這個資源 (如果是因為沒有登入，請參考 401 狀態碼)  | 登入成功，卻沒有權限可執行        |
| 404  | Not Found<br> 找不到      | 資源、檔案已經**不存在**了                                            | 該有的資料，卻找不到              |
| 409  | Conflict<br> 衝突         | 要建立的資源在伺服器上**已經有相同的存在**了 (如：名稱衝突、格式相同) | primary / unique key 已有相同資料 |
| 410  | Gone<br> 效期結束         | 當資源被有意地刪除並且資源應被清除時應該使用這個                      | Session 過期                      |
| 422  | Unprocessable Entity<br>  |                                                                       | Validate 錯誤                     |

#### \# 5xx - SERVER ERROR 伺服器錯誤

| Code | Description                        | Note               | RESTful API             |
|:-----|:-----------------------------------|:-------------------|:------------------------|
| 500  | Internal Server Error<br> 內部錯誤 | 伺服器出現**錯誤** | 新增 / 更新 / 刪除 失敗 |


### \# Licence
MIT LICENSE [![](https://png.icons8.com/external-link/win/16/2980b9)](https://github.com/jasechen/laravel-jsonponse/blob/master/LICENSE)
