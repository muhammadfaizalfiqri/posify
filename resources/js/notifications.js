const notificationButton =
    document.getElementById("notificationButton");

const notificationDropdown =
    document.getElementById("notificationDropdown");

const notificationBadge =
    document.getElementById("notificationBadge");

const notificationList =
    document.getElementById("notificationList");

const notificationCountText =
    document.getElementById("notificationCountText");

const markAllRead =
    document.getElementById("markAllRead");


function rupiah(angka) {

    return "Rp " + Number(angka || 0)
        .toLocaleString("id-ID");

}


async function loadNotifications() {

    try {

        const response = await fetch("/notifications", {

            headers: {
                "Accept": "application/json"
            }

        });

        if (!response.ok) {
            throw new Error("Gagal mengambil notifikasi");
        }

        const data = await response.json();

        updateBadge(data.unread_count);

        renderNotifications(data.notifications);

    } catch (error) {

        console.error(error);

        if (notificationList) {

            notificationList.innerHTML = `
                <div class="p-6 text-center text-red-400">
                    Gagal memuat notifikasi.
                </div>
            `;

        }

    }

}


function updateBadge(count) {

    if (!notificationBadge) return;

    if (count > 0) {

        notificationBadge.textContent =
            count > 99 ? "99+" : count;

        notificationBadge.classList.remove("hidden");

    } else {

        notificationBadge.classList.add("hidden");

    }

    if (notificationCountText) {

        notificationCountText.textContent =
            count > 0
                ? `${count} belum dibaca`
                : "Tidak ada notifikasi baru";

    }

}


function renderNotifications(notifications) {

    if (!notificationList) return;

    if (!notifications || !notifications.length) {

        notificationList.innerHTML = `

            <div class="p-8 text-center">

                <div class="text-4xl mb-3">
                    🔔
                </div>

                <p class="text-gray-500">
                    Belum ada notifikasi.
                </p>

            </div>

        `;

        return;

    }


    notificationList.innerHTML =
        notifications.map(notification => {

            const unread =
                notification.read_at === null;

            return `

                <div
                    class="notification-item
                           px-5 py-4
                           border-b
                           hover:bg-gray-50
                           cursor-pointer
                           ${unread ? "bg-blue-50" : ""}"
                    data-id="${notification.id}">

                    <div class="flex gap-3">

                        <div
                            class="w-10 h-10
                                   rounded-full
                                   bg-blue-100
                                   text-blue-600
                                   flex items-center
                                   justify-center
                                   flex-shrink-0">

                            <i class="fa-solid fa-receipt"></i>

                        </div>

                        <div class="flex-1">

                            <div class="flex
                                        justify-between
                                        gap-2">

                                <h4
                                    class="font-semibold
                                           text-gray-800">

                                    ${notification.title}

                                </h4>

                                ${
                                    unread
                                    ? `
                                    <span
                                        class="w-2 h-2
                                               rounded-full
                                               bg-blue-600
                                               mt-2">
                                    </span>
                                    `
                                    : ""
                                }

                            </div>

                            <p
                                class="text-sm
                                       text-gray-600
                                       mt-1">

                                ${notification.message}

                            </p>

                            ${
                                notification.total
                                ? `
                                <p
                                    class="text-sm
                                           font-semibold
                                           text-blue-600
                                           mt-1">

                                    ${rupiah(notification.total)}

                                </p>
                                `
                                : ""
                            }

                            <p
                                class="text-xs
                                       text-gray-400
                                       mt-2">

                                ${notification.created_at}

                            </p>

                        </div>

                    </div>

                </div>

            `;

        }).join("");


    document
        .querySelectorAll(".notification-item")
        .forEach(item => {

            item.addEventListener("click", async function () {

                const id = this.dataset.id;

                await markNotificationAsRead(id);

            });

        });

}


async function markNotificationAsRead(id) {

    try {

        await fetch(`/notifications/${id}/read`, {

            method: "POST",

            headers: {

                "X-CSRF-TOKEN":
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    )?.content,

                "Accept": "application/json"

            }

        });

        await loadNotifications();

    } catch (error) {

        console.error(error);

    }

}


notificationButton?.addEventListener(
    "click",
    function () {

        notificationDropdown
            ?.classList
            .toggle("hidden");

        if (
            notificationDropdown &&
            !notificationDropdown
                .classList
                .contains("hidden")
        ) {

            loadNotifications();

        }

    }
);


markAllRead?.addEventListener(
    "click",
    async function () {

        try {

            await fetch(
                "/notifications/read-all",
                {

                    method: "POST",

                    headers: {

                        "X-CSRF-TOKEN":
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            )?.content,

                        "Accept": "application/json"

                    }

                }
            );

            await loadNotifications();

        } catch (error) {

            console.error(error);

        }

    }
);


document.addEventListener(
    "click",
    function (event) {

        const wrapper =
            document.getElementById(
                "notificationWrapper"
            );

        if (
            wrapper &&
            !wrapper.contains(event.target)
        ) {

            notificationDropdown
                ?.classList
                .add("hidden");

        }

    }
);


// Jalankan hanya jika navbar notifikasi tersedia
if (notificationButton) {

    loadNotifications();

}