<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case Pending  = 'Menunggu Pembayaran';
    case Failed   = 'Transaksi Gagal';
    case Success  = 'Transaksi Sukses';
}
