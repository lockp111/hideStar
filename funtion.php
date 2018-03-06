<?php
function hideStar($str, $start, $length = 0)
{
    $i = 0;
    $star = '';
    if ($start >= 0) {
        if ($length > 0) {
            $str_len = mb_strlen($str);
            $count = $length;
            if ($start >= $str_len) { //当开始的下标大于字符串长度的时候，就不做替换了
                $count = 0;
            }
        } elseif ($length < 0) {
            $str_len = mb_strlen($str);
            $count = abs($length);
            if ($start >= $str_len) { //当开始的下标大于字符串长度的时候，由于是反向的，就从最后那个字符的下标开始
                $start = $str_len - 1;
            }
            $offset = $start - $count + 1; //起点下标减去数量，计算偏移量
            $count = $offset >= 0 ? abs($length) : ($start + 1); //偏移量大于等于0说明没有超过最左边，小于0了说明超过了最左边，就用起点到最左边的长度
            $start = $offset >= 0 ? $offset : 0; //从最左边或左边的某个位置开始
        } else {
            $str_len = mb_strlen($str);
            $count = $str_len - $start; //计算要替换的数量
        }
    } else {
        if ($length > 0) {
            $offset = abs($start);
            $count = $offset >= $length ? $length : $offset; //大于等于长度的时候 没有超出最右边
        } elseif ($length < 0) {
            $str_len = mb_strlen($str);
            $end = $str_len + $start; //计算偏移的结尾值
            $offset = abs($start + $length) - 1; //计算偏移量，由于都是负数就加起来
            $start = $str_len - $offset; //计算起点值
            $start = $start >= 0 ? $start : 0;
            $count = $end - $start + 1;
        } else {
            $str_len = mb_strlen($str);
            $count = $str_len + $start + 1; //计算需要偏移的长度
            $start = 0;
        }
    }

    while ($i < $count) {
        $star .= '*';
        $i++;
    }

    $cut = mb_substr($str, 1, $count);
    return str_replace($cut, $star, $str);
}