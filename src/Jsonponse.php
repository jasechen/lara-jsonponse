<?php

namespace Jasechen\Jsonponse;

use Illuminate\Routing\ResponseFactory as Response;


class Jsonponse
{

    /*
     *
     */
    public static function fail($comment, $code = 400, $data = [])
    {
        static::render('fail', $code, strval($comment), $data);
    } // END function

    /*
     *
     */
    public static function success($comment, $data = [], $code = 200)
    {
        static::render('success', $code, strval($comment), $data);
    } // END function

    /*
     *
     */
    private static function render($status, $code, $comment, $data)
    {
        $headers = [];
        $headers['Cache-Control'] = "no-transform, public, max-age=300, s-maxage=900";
        $headers['Content-Type']  = "application/json; charset=utf-8";

        $options = phpversion() >= 5.4 ? JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES : 0;

        $output = ['status' => $status, 'code' => $code, 'comment' => $comment];

        if (!empty($data)) {
            $output['data'] = self::parse2Str($data);
        } // END if

        Response()->json($output, $output['code'], $headers, $options)->send();
        exit();
    } // END function

    /*
     *
     */
    private static function parse2Str($value)
    {
        if (!is_array($value)) {
            if (is_object($value)) {
                $value = ($value instanceof Illuminate\Support\Collection) ? $value->toArray() : get_object_vars($value);
            } else {
                return is_string($value) ? $value : strval($value);
            } // END if else
        } // END if


        $data = [];

        foreach ($value as $i => $v) {
            $data[$i] = self::parse2Str($v);
        } // END foreach

        return $data;
    } // END function
}