import type { SweetAlertResult } from "sweetalert2";
import sweetalert from "../../modules/sweetalert";

window.addEventListener("DOMContentLoaded", () => {
    /** Popup action item. */
    const elementsAction = document.getElementsByClassName(
        "confirmActionTS"
    ) as HTMLCollectionOf<Element>;
    for (const element of elementsAction) {
        element.addEventListener("submit", function (e) {
            e.preventDefault();
            const el = e.target;
            if (!el || !(el instanceof HTMLFormElement)) {
                throw new Error(
                    "confirmDoneJS can only be executed on an exising form"
                );
            }
            sweetalert.methods.confirm(
                el,
                // eslint-disable-next-line @typescript-eslint/no-unused-vars
                function (response: SweetAlertResult<any>) {
                    el.submit();
                },
                { icon: "warning" },
                el.getAttribute("data-sweetalert-title") ?? undefined,
                el.getAttribute("data-sweetalert-message") ?? undefined,
                el.getAttribute("data-sweetalert-btn-accept") ?? undefined,
                el.getAttribute("data-sweetalert-btn-deny") ?? undefined,
                el.getAttribute("data-sweetalert-btn-color") ?? undefined,
            );
            return false;
        });
    }
    /** Transform navigation */
    const navigation = document.getElementById("navigation");
    const navigationLabels = document.querySelectorAll(".navigation-label");
    const btnSideMenuToggle = document.getElementById("side-menu-toggle") as HTMLButtonElement|null;
    btnSideMenuToggle?.addEventListener("click", function () {
        btnSideMenuToggle.disabled = true;
        navigation?.classList.toggle("navigation-sm");
        navigationLabels.forEach(navigationLabel => {
            if (!navigation?.classList.contains("navigation-sm")) {
                setTimeout(() => {
                    navigationLabel?.classList.toggle("d-none");
                    btnSideMenuToggle.disabled = false;
                }, 300);
            } else {
                navigationLabel?.classList.toggle("d-none");
                btnSideMenuToggle.disabled = false;
            }
        });
    });
});
