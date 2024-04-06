<?php 

namespace App\Core;


class Request
{
    public array $body = [];
    public array $params = [];

    /**
	 * 
     * This PHP function sanitizes and stores the values from the request and 
     * superglobal arrays in the $this->body array.
	 * 
     */
    public function __construct()
    {
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $this->body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $this->body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            foreach ($_FILES as $key => $file) {
                $this->body[$key] = $file;
            }
        }
    }

    /**
	 * 
     * The function `getPath` in PHP retrieves the current URL path from the `['REQUEST_URI']`
     * variable and removes any query parameters.
     * 
     * @return string the path of the current request URI.
	 * 
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI']; 
        $position = strpos($path, '?'); 
    
        return $position ? substr($path, 0, $position) : $path; 
    }

    public function startsWith($path): bool
    {
        return strpos($this->getPath(), $path) === 0;
    }

    /**
	 * 
     * The function returns the HTTP request method in lowercase.
     * 
     * @return string The method being returned is the lowercase value of the 'REQUEST_METHOD' server
     * variable.
	 * 
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']); 
    }

    /**
	 * 
     * The function checks if the HTTP method used is GET.
     * 
     * @return bool The function isGet() is returning a boolean value.
	 * 
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    /**
	 * 
     * The function checks if the HTTP method used is POST.
     * 
     * @return bool a boolean value, indicating whether the HTTP request method is 'post' or not.
     *
	 */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    /**
	 * 
     * The function sets the parameters of an object and returns the object itself.
     * 
     * @param array params An array of parameters that will be set for the object.
     * 
     * @return self The method is returning an instance of the class itself (self).
	 * 
     */
    public function setParams(array $params): self
    {
        $this->params = $params;
        return $this;
    }

   /**
	* 
    * The function "getParams" returns an array of parameters or null if no parameters are set.
    * 
    * @return array an array of parameters. If the `` property is not set, it will return
    * `null`.
	
    */
    public function getParams(): array
    {
        return $this->params ?? null;
    } 
}