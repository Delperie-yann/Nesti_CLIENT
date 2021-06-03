let passWord = document.querySelector("#pwd");

passWord.addEventListener("keyup", checkPassword);

function checkPassword() {

    var meter = document.getElementById("pwd_meter").value;
    var pwd = document.getElementById("pwd").value;

    var updated = 0;

    if (pwd.length > 8) {
        document.getElementById("pwd_warn1").style.color = "green";
        updated += 1;
    } else {
        document.getElementById("pwd_warn1").style.color = "red";
    }

    if (/[a-z]/.test(pwd)) {
        document.getElementById("pwd_warn2").style.color = "green";
        updated += 1;
    } else {
        document.getElementById("pwd_warn2").style.color = "red";
    }

    if (/[A-Z]/.test(pwd)) {
        document.getElementById("pwd_warn3").style.color = "green";
        updated += 1;
    } else {
        document.getElementById("pwd_warn3").style.color = "red";
    }

    if (/[0-9]/.test(pwd)) {
        document.getElementById("pwd_warn4").style.color = "green";
        updated += 1;
    } else {
        document.getElementById("pwd_warn4").style.color = "red";
    }

    if (/[^a-zA-Z0-9]/.test(pwd)) {
        document.getElementById("pwd_warn5").style.color = "green";
        updated += 1;
    } else {
        document.getElementById("pwd_warn5").style.color = "red";
    }

    document.getElementById("pwd_meter").value = updated;

    if (updated === 5) {
        PWD_CHECK = 1;
    } else {
        PWD_CHECK = 0;
    }
}



