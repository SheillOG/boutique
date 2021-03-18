$("#mdp").hide();
test = false;

$("button").click(function(){
    console.log($("#identifiant").val() );
    if($("#identifiant").val() == "test"){
        $("#erreurIdentifiant").html("entrez un mdp").css("color","green");
        $("#mdp").show('fade');
        test = true;
        $("#erreurIdentifiant").html("");
        $("#erreurMail").html("");
    } else{
        $("#erreurIdentifiant").html("identifiant introuvable").css("color","red");
        $("#mdp").hide('fade');
        test = false;
    }

    if(test = true) {
        if ($("#mdp").val() == "test") {
            $("#erreurMail").html("bienvenue").css("color", "green");
        } else {
            $("#erreurMail").html("mdp incorecte").css("color", "red");
        }
    }




    // if($("#identifiant").val() == "") {
    //     alert("entre un email");
    // }
});

