# The Solution
### Question:
How to load Pivot data from a Belongs To Many relations?

#### Answer:
Here is my interpretation of your database and its relations. You can review all the migrations into the repository. My intent here is not to define your structure as is but to help you understand how Laravel works. I hope after this, you can change, adapt or update your project values as needed.
![database_design](https://raw.githubusercontent.com/ricardov03/btm-pivot-relations/main/resources/images/database_structure.png)

I expect to provide you with information about how to interact with your Pivot tables and how to manipulate them to hide and transform data by casting the pivot table properties. Laravel uses the relational Pivot table as an add-on. If you need this information, you need to _attach_ the details of the required pivot data in the model.

First, you can define the relationships on any model, but I choose to present the pivot data on the `Product` model. Here's the model definition (All the dots represent hidden data to simplify the class definition, but you can review the whole model [here](https://github.com/ricardov03/btm-pivot-relations/blob/main/app/Models/Product.php)):
```php
<?php
...
class Product extends Model
{
...

    protected $with = ['properties']; // 6

    public function properties(): BelongsToMany // 1
    {
        return $this->belongsToMany(Property::class) // 2
            ->as('attributes') // 3
            ->using(ProductProperty::class) // 4
            ->withPivot('position'); // 5
    }
}

```

Let's explain what's happened here:
1. The `properties` methods represent the relation between the **Product** and their **Attributes**.
2. As **Product** is the parent object, you could represent this relationship with a `hasMany` relation, but it disallows you from relating the Pivot table. To connect the _Pivot_ table, you must define this relation as a `BelongsToMany` relation. This unlocks all the other methods specified in the example.
3. The `as` method allows you to rename the relation. By default, Laravel calls any pivot-loaded data by the `pivot` keyword. In this case, we rename this with the `attributes` value.
4. The `using` method allows you to use a defined Pivot model to cast and modify the behavior of the data retrieved from the Pivot table.
5. The `withPivot` method defines all the extra required fields from the Pivot relation. By default, Laravel loads the primary key columns from the related base models. In this case, I'm adding the `position` column from the Pivot table.
6. The `$with` protected variable defines which relations should be loaded when you call the Product model. In this case, I'm adding all the Properties of a Product when you load any product.

Next, let's explain what happens on the ProductProperty Model (You can review the whole model [here](https://github.com/ricardov03/btm-pivot-relations/blob/main/app/Models/ProductProperty.php)):
```php
<?php
...
class ProductProperty extends Pivot // 1
{
    protected $casts = [ // 2
        'position' => 'integer',
    ];

    protected $hidden = [ // 3
        'product_id',
        'property_id',
    ];
}
```
Let's explain as before:
1. As you can see, the `ProductProperty` class extends the `Pivot` class. This is REALLY important. This is how Laravel identifies this as a Pivot relation and not a base model. (And that's why you can use this in the Product model with the `using` method).
2. The `$cast` protected property allows you to define column types to take advantage of data transformation. More info here: [Eloquent: Mutators & Casting](https://laravel.com/docs/9.x/eloquent-mutators)
3. The `$hidden` protected property allows you to define the list of columns you don't want to present when you see a relationship that includes this Pivot table Model definition.

Ok. Now you know how to define the Pivot relation. But, How can I use it?
Let's check the `ProductController` definition  (You can review the whole controller [here](https://github.com/ricardov03/btm-pivot-relations/blob/main/app/Http/Controllers/ProductController.php)):
```php
<?php
...
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all(); // 1
        return new ProductCollection($products); // 2
    }
}

// Returned data:
/**
{
   "data":[
      {
         "id":1,
         "name":"Costa Rica",
         "properties":[
            {
               "id":1,
               "name":"DeepSkyBlue",
               "attributes":{ // By default Laravel use 'pivot' here, but we replace this with the 'attributes' name.
                  "position":8
               }
            },
            {
               "id":2,
               "name":"Azure",
               "attributes":{
                  "position":8
               }
            },
            {
               "id":3,
               "name":"LavenderBlush",
               "attributes":{
                  "position":8
               }
            }
         ]
      },
    ... // Sample of 1 Product with 3 Properties
   ]
}
 */
```
What's happening here:
1. I'm calling all the existing products from the Database. As we have the `$with` property defined on the Product model, all Products are returned with their Properties.
2. I'm returning the Products wrapped on API Resources to allow the transformation of the Endpoint structure if needed in the future. Here is more information: [Eloquent: API Resources](https://laravel.com/docs/9.x/eloquent-resources#main-content)

Well, that's it! Here I covered the basics as simply as I can. I hope this information could help.

---
For this example, I used Laravel Blueprint to accelerate the project scaffolding. You can read more about it here: [Laravel Blueprint](https://blueprint.laravelshift.com/)
