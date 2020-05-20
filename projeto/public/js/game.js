var blockednums=[];
function blockNumbers(num,total,player,url){
    var index=blockednums.indexOf(num);
    console.log("Index:"+index);
    if(index===-1){
        if(player==="player1")
        {
            $("#PL1num"+num).removeClass("box-active-blue");
            $("#PL1num"+num).addClass("box-blocked");
        }


        blockednums.push(num);
    }
    else{

        if(player==="player1")
        {
            $("#PL1num"+num).removeClass("box-blocked");
            $("#PL1num"+num).addClass("box-active-blue");
        }

        blockednums.splice(index,1);
    }
    var totalBlockeados=blockednums.reduce(function(acc, val) { return acc + val; }, 0);
    console.log(blockednums);
    console.log("Total:"+totalBlockeados);
    console.log("Dice:"+total);
    if(totalBlockeados===total){
        for(var number in blockednums){
            console.log("remoce:"+number);
            $("#PL1num"+blockednums[number]).prop("onclick",null).off("click");
        }
        console.log("feito");
        $.ajax({
            method:"post",
            url:url,
            data:{"numblock":blockednums,"player":player}
        }).done(function () {
          window.location.href=window.location.href;
        });


    }
    else{
        console.log("Fazendo");
    }
}

