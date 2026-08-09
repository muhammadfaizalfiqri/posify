import { closeModal } from "./modal";

let cart = [];

window.grandTotal = 0;

const cartBody = document.getElementById("cart-body");
const subtotalText = document.getElementById("subtotalText");
const grandTotalText = document.getElementById("grandTotalText");

const bayarInput = document.getElementById("bayar");
const kembalianInput = document.getElementById("kembalian");

const paymentMethod = document.getElementById("payment_method");

const grandTotalInput = document.getElementById("grandTotalInput");
const cartData = document.getElementById("cartData");

const form = document.getElementById("transactionForm");

function rupiah(angka) {

    return "Rp " + Number(angka).toLocaleString("id-ID");

}

function hitungTotal() {

    let subtotal = 0;

    cart.forEach(item => {

        subtotal += item.qty * item.harga;

    });

    window.grandTotal = subtotal;

    subtotalText.textContent = rupiah(subtotal);

    grandTotalText.textContent = rupiah(subtotal);

    grandTotalInput.value = subtotal;

    hitungKembalian();

}

function hitungKembalian() {

    if (paymentMethod.value === "midtrans") {

        kembalianInput.value = "Rp0";

        return;

    }

    const bayar = Number(bayarInput.value || 0);

    if (bayar < window.grandTotal) {

        kembalianInput.value = "Rp0";

        return;

    }

    kembalianInput.value = rupiah(

        bayar - window.grandTotal

    );

}

function renderCart() {

    cartBody.innerHTML = "";

    if (cart.length === 0) {

        cartBody.innerHTML = `

        <tr>

            <td colspan="6"

                class="py-10 text-center text-gray-400">

                Keranjang kosong

            </td>

        </tr>

        `;

        hitungTotal();

        cartData.value = JSON.stringify([]);

        return;

    }

    cart.forEach(item => {

        cartBody.innerHTML += `

        <tr class="border-b">

            <td class="px-6 py-4">

                ${item.kode}

            </td>

            <td>

                ${item.nama}

            </td>

            <td class="text-center">

                ${item.qty}

            </td>

            <td class="text-right">

                ${rupiah(item.harga)}

            </td>

            <td class="text-right">

                ${rupiah(item.qty * item.harga)}

            </td>

            <td class="text-center">

                <button

                    type="button"

                    class="hapus text-red-600"

                    data-id="${item.id}">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </td>

        </tr>

        `;

    });

    cartData.value = JSON.stringify(cart);

    hitungTotal();

    document.querySelectorAll(".hapus").forEach(btn => {

        btn.onclick = () => {

            cart = cart.filter(i => i.id != btn.dataset.id);

            renderCart();

        }

    });

}

document.querySelectorAll(".btnTambah").forEach(btn => {

    btn.onclick = function () {

        const id = this.dataset.id;

        const exist = cart.find(i => i.id == id);

        if (exist) {

            exist.qty++;

        } else {

            cart.push({

                id: id,

                kode: this.dataset.kode,

                nama: this.dataset.nama,

                harga: Number(this.dataset.harga),

                qty: 1

            });

        }

        renderCart();

        closeModal();

    }

});

bayarInput.addEventListener("input", hitungKembalian);

paymentMethod.addEventListener("change", function(){

    if(this.value==="midtrans"){

        bayarInput.parentElement.style.display="none";

        kembalianInput.parentElement.style.display="none";

    }else{

        bayarInput.parentElement.style.display="block";

        kembalianInput.parentElement.style.display="block";

    }

});

form.addEventListener("submit",function(e){

    e.preventDefault();

    if(cart.length===0){

        Swal.fire({

            icon:"warning",

            title:"Keranjang kosong"

        });

        return;

    }

    if(

        paymentMethod.value==="cash"

        &&

        Number(bayarInput.value||0)<window.grandTotal

    ){

        Swal.fire({

            icon:"error",

            title:"Pembayaran kurang"

        });

        return;

    }

    cartData.value=JSON.stringify(cart);

    const formData=new FormData(form);

    fetch(form.action,{

        method:"POST",

        headers:{

            "X-CSRF-TOKEN":

            document.querySelector(

                'meta[name="csrf-token"]'

            ).content,

            "Accept":"application/json"

        },

        body:formData

    })

    .then(res=>res.json())

    .then(res=>{

        if(!res.success){

            Swal.fire({

                icon:"error",

                title:"Gagal",

                text:res.message

            });

            return;

        }

        if(res.payment_method==="cash"){

            Swal.fire({

                icon:"success",

                title:"Transaksi Berhasil"

            }).then(()=>{

                location.reload();

            });

            return;

        }

        snap.pay(res.snap_token,{

            onSuccess:function(){

                Swal.fire({

                    icon:"success",

                    title:"Pembayaran Berhasil"

                }).then(()=>{

                    location.reload();

                });

            },

            onPending:function(){

                Swal.fire({

                    icon:"info",

                    title:"Menunggu Pembayaran"

                });

            },

            onError:function(){

                Swal.fire({

                    icon:"error",

                    title:"Pembayaran Gagal"

                });

            }

        });

    });

});