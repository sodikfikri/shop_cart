jQuery(function($) {
    let Shop = {
        toas: Swal.mixin({
            toast: true,
            icon: "success",
            title: "General Title",
            animation: false,
            position: "top-right",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        })
    }

    Shop.active = function() {
        Shop.API.active()
        Shop.Event.active()
    }

    Shop.API = {
        active: function() {
            $.ajax({
                url: '/api/coupon_list',
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $.each(resp.data, function(key, val) {
                            $('#code-discount').append(
                                `<option value="${val.code}">${val.code}</option>`
                            )
                        })
                    }
                }
            })

            this.get_total_price()
        },
        detail: function(id) {
            $.ajax({
                url: '/api/detail',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $('#id-hide').val(resp.data.id)
                        $('#form-qty').val(resp.data.quantity)
                    }
                    $('#modal-qty').modal('show')
                }
            })
        },
        update_qty: function(params) {
            $.ajax({
                url: '/api/update_qty',
                method: 'PUT',
                data: params,
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        location.reload()
                    } else {
                        Shop.toas.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                }
            })
        },
        get_total_price: function() {
            $.ajax({
                url: '/api/total_price',
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $('#grand-price').html(`Rp. ${new Intl.NumberFormat().format(resp.data)}`)
                    }
                }
            })
        },
        delete: function(idx) {
            $.ajax({
                url: '/api/delete',
                method: 'DELETE',
                data: {
                    id: idx
                },
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        location.reload()
                    }
                }
            })
        }
    }
    Shop.Event = {
        active: function() {
            $('#dataTable tbody').on('click', '#e-qty', function() {
                // console.log($(this).data('id'));
               Shop.API.detail($(this).data('id'))
            })

            $('#btn-update-qty').on('click', function() {
                let params = {
                    id: $('#id-hide').val(),
                    qty: $('#form-qty').val()
                }

                Shop.API.update_qty(params)
            })

            $('#dataTable tbody').on('click', '#delete', function(){
                let idx = $(this).data('id')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancel: false
                }).then(function(result) {
                    if (result.isConfirmed) {
                        Shop.API.delete(idx)
                    }
                })
            })

            this.discount()
        },
        discount: function() {
            $('#btn-save-discount').on('click', function() {
                if ($.trim($('#code-discount').val()) == '') {
                    Shop.toas.fire({
                        icon: "error",
                        title: 'Kode diskon tidak boleh kosong!',
                    });
                }

                let data1 = $('#dataTable tbody').find('#FA4532').find('#total-price').html()
                if (data1 != undefined) {
                    data1 = data1.replaceAll('Rp. ', '')
                    data1 = data1.replaceAll(',','')
                } else {
                    data1 = 0
                }

                let data2 = $('#dataTable tbody').find('#FA3518').find('#total-price').html()
                if (data2 != undefined) {
                    data2 = data2.replaceAll('Rp. ', '')
                    data2 = data2.replaceAll(',','')
                } else {
                    data2 = 0
                }
                // return alert(data2)
                if ($('#code-discount').val() == 'FA111') {
                    let percentage1 = parseInt(10) / parseInt(100) * parseInt(data1)
                    let percentage2 = parseInt(10) / parseInt(100) * parseInt(data2)

                    let subtotal1 = parseFloat(data1) - parseFloat(percentage1)
                    let subtotal2 = parseFloat(data2) - parseFloat(percentage2)

                    let sumtotal  = parseFloat(subtotal1) + parseFloat(subtotal2)

                    $('#dataTable tbody').find('#FA4532').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal1))
                    $('#dataTable tbody').find('#FA3518').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal2))
                    $('#grand-price').html('Rp. ' + new Intl.NumberFormat().format(sumtotal))
                }
                
                if ($('#code-discount').val() == 'FA222') {
                    if (data1 != 0) {
                        let subtotal1 = parseInt(data1) - parseInt(50000)
                            subtotal1 = subtotal1 >= 0 ? subtotal1 : 0
                        let sumtotal  = parseFloat(subtotal1) + parseFloat(data2)
                            sumtotal  = sumtotal >= 0 ? sumtotal : 0
                        $('#dataTable tbody').find('#FA4532').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal1))
                        $('#grand-price').html('Rp. ' + new Intl.NumberFormat().format(sumtotal))
                    } else {
                        Shop.toas.fire({
                            icon: "error",
                            title: 'Diskon tidak bisa digunakan, barang tidak di temukan!',
                        });
                        return false;
                    }
                }

                if ($('#code-discount').val() == 'FA333') {
                    if (data1 < 400000 && data2 < 400000) {
                        Shop.toas.fire({
                            icon: "error",
                            title: 'Diskon tidak bisa digunakan, minimal belanja 400.000',
                        });
                        return false;
                    }
                    let subtotal1 = ''
                    let subtotal2 = ''

                    if (data1 > 400000) {
                        let percentage1 = parseInt(6) / parseInt(100) * parseInt(data1)
                        subtotal1 = parseFloat(data1) - parseFloat(percentage1)
                    } else {
                        subtotal1 = parseInt(data1)
                    }

                    if (data2 > 400000) {
                        let percentage2 = parseInt(6) / parseInt(100) * parseInt(data2)
                        subtotal2 = parseFloat(data2) - parseFloat(percentage2)
                    } else {
                        subtotal2 = parseInt(data2)
                    }

                    let sumtotal  = parseFloat(subtotal1) + parseFloat(subtotal2)
                    $('#dataTable tbody').find('#FA4532').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal1))
                    $('#dataTable tbody').find('#FA3518').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal2))
                    $('#grand-price').html('Rp. ' + new Intl.NumberFormat().format(sumtotal))
                }

                if ($('#code-discount').val() == 'FA444') {
                    // let day = moment('2023-05-23 14:34:21').format('dd')
                    // let hr = moment('2023-05-23 14:34:21').format('HH')

                    let day = moment().format('dd')
                    let hr = moment().format('HHmm')
                    // return console.log(hr);
                    if (day == 'Tu') {
                        if (hr >= '1300' && hr <= '1500') {
                            let percentage1 = parseInt(5) / parseInt(100) * parseInt(data1)
                            let percentage2 = parseInt(5) / parseInt(100) * parseInt(data2)

                            let subtotal1 = parseFloat(data1) - parseFloat(percentage1)
                            let subtotal2 = parseFloat(data2) - parseFloat(percentage2)

                            let sumtotal  = parseFloat(subtotal1) + parseFloat(subtotal2)

                            $('#dataTable tbody').find('#FA4532').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal1))
                            $('#dataTable tbody').find('#FA3518').find('#total-price').html('Rp. '+ new Intl.NumberFormat().format(subtotal2))
                            $('#grand-price').html('Rp. ' + new Intl.NumberFormat().format(sumtotal))
                        } else {
                            Shop.toas.fire({
                                icon: "error",
                                title: 'Diskon hanya berlaku pada hari selasa dari jam 13.00 sd 15.00',
                            });
                            return false;
                        }
                    } else {
                        Shop.toas.fire({
                            icon: "error",
                            title: 'Diskon hanya berlaku pada hari selsa dari jam 13.00 sd 15.00',
                        });
                        return false;
                    }
                }

                $('#code-reward').html(`(${$('#code-discount').val()})`)
                $('#modal-discount').modal('hide')
                Shop.toas.fire({
                    icon: "success",
                    title: 'Diskon berhasil digunakan',
                });
            })
        }
    }

    Shop.active()
})