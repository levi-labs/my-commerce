<?php


function createCodeItem($table, $code)
{
    $count  = $table->count();
    if ($count == 0) {
        $counter  = '0001';
        /**
         * return $code . '-' . $counter;
         */
        $number = $code . '-' . sprintf('%04s', $counter);
        return $number;
    } else {
        $last_item = $table->all()->last();
        // Mengambil 4 karakter terakhir dari kode terakhir dan mengkonversinya menjadi integer
        // Lalu menambahkan 1 untuk menghasilkan kode baru
        $replace = (int) substr($last_item->code, 4) + 1;
        $number = $code . '-' . sprintf('%04s', $replace);
        return $number;
    }
}
