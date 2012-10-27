# CakePHP Dependent Field Validation Rule

Creates a rule with the ability to determine if a field is valid depending on
the value of one, or more, other fields.

## Setup

Copy the code into the CakePHP model file you would like to use the validation with.

## Example

If field A needs to equal 1, and B need to equal 2 or 3, to check if C 
is empty it would look something like:

```php
<?php

'C' => array(
	'notempty' => array(
		'rule' => array('dependentEmpty', array('A'=>1, 'B'=>array(2, 3))),
		'message' => 'C cannot be empty when A=1 and B=2 or 3, please enter a value'
	)
)

```

### Special Case

If a value is set equal to NULL it will be checked using empty() so it escapes 
if the specified field does not exist/is empty and the validating field 
contains a value.

The third parameter $type can be used to define custom validations that can be entered in the function.