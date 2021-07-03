var sideMenu = false;
var sideBarWidth = 0;
var mainWidth = 100;
var currentTabId  = 'main';


function openModal(modalId) {
    document.getElementById("modals").style.display = "block";
    var modal = document.getElementById(modalId);
    console.log(modal);
    modal.style.display = "inline-block";
}

function closeModal(modalId) {
    document.getElementById("modals").style.display = "none"
    var modal = document.getElementById(modalId);
    modal.style.display = "none";
}

function toggleSideMenu(sit = sideMenu) {
    var menu = document.getElementById("mySidenav");
    var main = document.getElementById("main");
    if (!sit) {
        menu.style.display = "block";
        var setIntervalSideMenuWidth = setInterval(function () {
            if (sideBarWidth >= 30) {
                clearInterval(setIntervalSideMenuWidth);

            } else {


                menu.style.width = sideBarWidth + "%";
                main.style.width = mainWidth + "%";

                sideBarWidth += 1;
                mainWidth -= 1;
            }
        }, 10);
        sideMenu = true;

        var menu = document.getElementById("mySidenav");
        var toggleBtn = document.getElementById("mySidenavToggleBtn");
        window.onclick = function (event) {

            if (!event.path.includes(menu) && event.target != toggleBtn) {
                toggleSideMenu(true);

            }
        }
    } else {

        var setIntervalSideMenuWidth = setInterval(function () {
            if (sideBarWidth <= 1) {
                clearInterval(setIntervalSideMenuWidth);
                menu.style.display = "none";

            } else {


                menu.style.width = sideBarWidth + "%";
                main.style.width = mainWidth + "%";
                sideBarWidth -= 1;
                mainWidth += 1;

            }
        }, 1);


        sideMenu = false;


    }
}

function changeTab(tabId) {

    document.getElementById(tabId).style.display="block";
    document.getElementById(currentTabId).style.display="none";
    currentTabId = tabId;
    toggleSideMenu();
}