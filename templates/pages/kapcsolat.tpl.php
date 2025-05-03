<h2>Kapcsolatfelvétel</h2>
<form action="kapcsolat" method="post" onsubmit="return ellenorizKapcsolat();">
    <label for="uzenet">Üzenet:</label><br>
    <textarea id="uzenet" name="uzenet"></textarea><br><br>

    <input type="submit" value="Küldés">
</form>

<script>
function ellenorizKapcsolat() {
    
    const uzenet = document.getElementById("uzenet").value.trim();

    if (!uzenet) {
        alert("Minden mező kitöltése kötelező!");
        return false;
    }
    return true;
}
</script>
