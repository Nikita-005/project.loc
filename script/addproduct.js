let baseCategory = document.querySelector('#baseCat');
let divSubCat = document.querySelector('#subcat');
let addProductForm = document.querySelector('#add_product');
let labelSubCatLevel1 = document.querySelector('#labelSubCatLevel1');
let label = document.querySelector('.form-label');
if(baseCategory.options[0].selected == false){
    subCatLevel1.classList.remove('hidden');
}

console.log(allCategories);

function showSelectSubCat(e, categories, idSelectedCategory, idParentCategory){
    let selectedCategory = categories.find(function(item){
        return item.id == idSelectedCategory;
    });
    // если выбрана не подкатегория - выходим
    if(selectedCategory.cat_type != 'subcat'){
        return;
    }
    let labelSubCat = document.createElement('label');
    labelSubCat.textContent = 'Подкатегория';
    labelSubCat.classList.add('form-label');
    let selectSubCat = document.createElement('select');
    selectSubCat.name = 'category';
    let subCategories = allCategories.filter(item => item.parent_id == selectedCategory.id);
    let firstOption = document.createElement('option');
    firstOption.value = 0;
    firstOption.text = 'Выберите подкатегорию';
    selectSubCat.appendChild(firstOption);
    for(let i=0; i < subCategories.length; i++){
        let option = document.createElement('option');
        option.value = subCategories[i].id;
        option.text = subCategories[i].title;
        selectSubCat.appendChild(option);
    }
    selectSubCat.addEventListener('change', event => showSelectSubCat(event, subCategories, selectSubCat.value));
    labelSubCat.appendChild(selectSubCat);
    divSubCat.appendChild(labelSubCat);
}
function removeSubCats(idSelectedCategory){
    let cats = document.querySelectorAll('.form-label');
    for(let i = 1; i < cats.length; i++){
        divSubCat.removeChild(cats[i]);
    }
}
baseCategory.addEventListener('change', function(){
    if(this.value == 0 ){
        removeSubCats(0);
    }else{
        showSelectSubCat(0, allCategories, baseCategory.value, 0);
    }
})