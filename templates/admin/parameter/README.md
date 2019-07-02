# Creating a new parameter

First create a new parameter with the UI on route 
`admin/parameter/new`

![alt text](https://github.com/newQuery/damnWork/blob/master/public/readme/createparameter.PNG?raw=true)

Next, create a new template for your parameter. In my case I will create `admin/parameter/forms/new_parameter.html.twig`

Inside is the inputs of your new parameter's attributes

I want to give a name to my new_parameter:

```html
<div class="row pt-5">
    <div class="input-group col-md-12">
        <div class="input-group-prepend">
            <span class="input-group-text" id="name_of_my_new_parameter">Name</span>
        </div>
        <input type="text" name="parameter[parameters][name_of_my_new_parameter]" class="form-control" value="{% if form.parameters['name_of_my_new_parameter'] is defined %}{{ form.parameters['name_of_my_new_parameter'].vars.value }}{% endif %}">
    </div>
</div>
```

![alt text](https://github.com/newQuery/damnWork/blob/master/public/readme/create_attribute.PNG?raw=true)

![alt text](https://github.com/newQuery/damnWork/blob/master/public/readme/result_create_attribute.PNG?raw=true)

