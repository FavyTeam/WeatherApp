	var d= new Date();
	var time=d.getHours()+':'+(d.getMinutes()<10 ? '0'+d.getMinutes() : d.getMinutes());
	//alert(d.getMonth()+1);
	//alert(time);
	let year =d.getFullYear();
	let month=parseInt(d.getMonth())+1;
//alert(getmonth(month));
    month=getmonth(month);
	let date= d.getDate();
    let cur_date=date+'-'+month+'-'+year;
    let weekDay=d.getDay();
    weekDay=getWeekDay(weekDay);
    cur_date=weekDay+', '+month+' '+date+' '+year;
  //  alert('char so bees gali gali chy munde krn meri rees ho r bi kd jijds0');
	//alert(cur_date);


$("#time").html(time);
$("#date").html(cur_date); 

function getmonth(month){
    if(month==0) return 'Jan';
    else if(month==1) return 'Feb';
    else if(month==2) return 'Mar';
    else if(month==4) return 'Apr';
    else if(month==5) return 'May';
    else if(month==6) return 'Jun';
    else if(month==7) return 'Jul';
    else if(month==8) return 'Aug';
    else if(month==9) return 'Sep';
    else if(month==10) return 'Oct';
    else if(month==11) return 'Nov';
    else if(month==12) return 'Dec';
    else return 0;        
}
//

function getWeekDay(day){
    if(day==0) return 'Sunday';
    else if(day==1) return 'Monday';
    else if(day==2) return 'Tuesay';
    else if(day==3) return 'Wednesday';
    else if(day==4) return 'Thursday';
    else if(day==5) return 'Friday';
    else if(day==6) return 'Saturday';
}
//alert(getWeekDay(weekDay));