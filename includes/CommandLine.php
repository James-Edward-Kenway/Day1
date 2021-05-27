<?php


class CommandLine {

    /**
     * Input Stream
     *
     * @var resource
     */
    private $stdin;

    /**
     * Error Stream
     *
     * @var resource
     */
    private $stderr;

    /**
     * Maximum characters to read from command line
     *
     * @var int
     */
    private $maxCharLimit;

    /**
     * Initializing CommandLine
     *
     * @param integer $maxCharLimit = 0
     */
    function __construct($maxCharLimit = 0) {

        // Error Stream is opening
        $this->stderr = fopen('php://stderr', 'w');

        $this->maxCharLimit = $maxCharLimit;

    }

    /**
     * Push message to the CommandLine in a new line
     *
     * @param string $text
     * @return void
     */
    public function error ($text) {
        fwrite($this->stderr, $text);
        echo "\n" . $text . "\n";
    }

    /**
     * Push message to the CommandLine in a new line
     *
     * @param string $text
     * @return void
     */
    public function writeLine ($text) {
        echo "\n" . $text;
    }

    /**
     * Push message to the CommandLine in the same line
     *
     * @param string $text
     * @return void
     */
    public function write ($text) {
        echo $text;
    }

    /**
     * Read the message. Fetch text from chars when Enter is clicked
     *
     * @return string
     */
    public function read () {

        $this->stdin = fopen('php://stdin', 'r');

        $text = "";

        while (true) {
            $char = stream_get_contents($this->stdin, 1);

            // check if enter is clicked
            if ($char == ("\n" | "\r\n")) {
                break;
            }

            // check if char was read correctly and append it to the text
            if ($char) {
                $text .= $char;
            }

            // check if the read chars reached max limit
            if (mb_strlen($text) >= $this->maxCharLimit) {
                break;
            }
        }

        return $text;
    }

    /**
     * Read message from a new line
     *
     * @return string
     */
    public function readLine () {
        echo "\n";
        return $this->read();
    }

    /**
     * Class destruction
     */
    function __destruct() {
        // Closing Input Stream
        fclose($this->stdin);
        fclose($this->stderr);
    }
}