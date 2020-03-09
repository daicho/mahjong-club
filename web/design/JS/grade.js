let grade_name = document.getElementsByClassName("grade_type");
let grade_num = document.getElementsByClassName("grade");

const grade_each = new Array("成績", "役", "アガリ翻数");

let type_num = 0;
const max_num = 2;
const min_num = 0;

const leftClick = () => { 
    type_num -= 1;
    if(type_num < min_num) type_num = max_num;

    insertName(type_num);
    changeDisp(type_num);
}

const rightClick = () => {
    type_num += 1;
    if(type_num > max_num) type_num = min_num;

    insertName(type_num);
    changeDisp(type_num);
}

const insertName = (num) => {
    grade_name[0].innerHTML = grade_each[num];
    grade_name[1].innerHTML = grade_each[num];
}

const changeDisp = (num) => {
    for(let i = min_num; i <= max_num; i++)
    {
        grade_num[i].style.display = (num == i) ? "block" : "none";
    }
}