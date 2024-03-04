// function  count time

function countTime(time,element=".time-count-body",title ='.time-count-title') {
    let timeNow = time
    let id=  setInterval(function () {
      if(timeNow ==0){
        clearInterval(id)
        $(title).text('Mã xác nhận đã hết hạn!').css('color','red')
      }else{
        timeNow --
        $(element).text(timeNow+"s")
      }
    },1000)
  }