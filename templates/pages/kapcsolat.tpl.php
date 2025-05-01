<h2>Kapcsolatfelvétel</h2>
<form action="kapcsolat" method="post" onsubmit="return ellenorizKapcsolat();">
    <label for="nev">Név:</label><br>
    <input type="text" id="nev" name="nev"><br><br>

    <label for="email">E-mail:</label><br>
    <input type="text" id="email" name="email"><br><br>

    <label for="uzenet">Üzenet:</label><br>
    <textarea id="uzenet" name="uzenet"></textarea><br><br>

    <input type="submit" value="Küldés">
</form>

<script>
function ellenorizKapcsolat() {
    const nev = document.getElementById("nev").value.trim();
    const email = document.getElementById("email").value.trim();
    const uzenet = document.getElementById("uzenet").value.trim();

    if (!nev || !email || !uzenet) {
        alert("Minden mező kitöltése kötelező!");
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Hibás email formátum!");
        return false;
    }

    return true;
}
</script>
