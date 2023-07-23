<?php

function toRupiah($data) {
    return 'Rp' . number_format($data, 0, '.','.');
}
