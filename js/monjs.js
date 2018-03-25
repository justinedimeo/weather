// Here is the JS explained. 

// number of drops created.
let $nbDrop = 800; 

// rain
const $rain = document.querySelector('.rain')

// function to generate a random number range.
const randRange = ( minNum, maxNum) => {
  return (Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum)
}

// function to generate drops
const createRain = () => {

	for( i=0 ; i < $nbDrop ; i++) {
	let $dropLeft = randRange(0,1600)
    let $dropTop = randRange(-1000,5050)
    const $div = document.createElement("div")
    $rain.append($div)
    $div.setAttribute("class","drop")
    $div.setAttribute("id","drop"+i)
    $div.style.left = $dropLeft + 'px'
    $div.style.top = $dropTop + 'px'
	}

}
// make it rain
createRain();