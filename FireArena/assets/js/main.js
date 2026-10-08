const counters=document.querySelectorAll(".counter");

counters.forEach(counter=>{

    const update=()=>{

        const target=+counter.dataset.target;

        const count=+counter.innerText;

        const speed=100;

        const increment=Math.ceil(target/speed);

        if(count<target){

            counter.innerText=count+increment;

            setTimeout(update,20);

        }else{

            counter.innerText=target;

        }

    };

    update();

});