/* 
* Determine if a field is valid depending on the value of one, or more, other fields.
*
* For example, if field A needs to equal 1, and B need to equal 2 or 3, to check if C is empty it would look something like:
* 'C' => array(
* 	'notempty' => array(
*		'rule' => array('dependentEmpty', array('A'=>1, 'B'=>array(2, 3))),
*		'message' => 'C cannot be empty when A=1 and B=2 or 3, please enter a value'
*	)
* )
*
* Special case: If a value is set equal to NULL it will be checked using empty() so it escapes if the specified field
* does not exist/is empty and the validating field contains a value.
*
* The third parameter $type can be used to define custom validations that can be entered in the function.
*/

public function dependentEmptyConditional($check, $args, $type=null) {
	$check = array_values($check);

	foreach ($args as $fieldname => $vals) {
		// if the value is not within the args to check for return
		if ((is_array($vals) && !in_array($this->data[$this->name][$fieldname], $vals)) || 
			(!is_array($vals) && !empty($vals) && ($this->data[$this->name][$fieldname] !== $vals)) || 
			(!is_array($vals) && ($vals === null) && !empty($this->data[$this->name][$fieldname]))) {
			return true;
		}
	}

	switch ($type) {
		case 'email':
			if (!filter_var($check[0], FILTER_VALIDATE_EMAIL)) return false;
			break;
		case 'link':
		case 'url':
			if (!filter_var($check[0], FILTER_VALIDATE_URL)) return false;
			break;
		case 'upload':
			if (empty($check[0]['name'])) return false;
			break;
		default:
			if (empty($check[0])) return false;			
	}

	return true;
}