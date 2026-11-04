<?php

class ApiResponse {
    protected int $code = 200;
    protected mixed $data = null;
    protected string $message = '';

    // Magic getter to handle syntax like $Response->success or $Response->error
    public function __get(string $name) {
        if (strtolower($name) === 'success') {
            $this->code = 200;
        } elseif (in_array(strtolower($name), ['error', 'fail'])) {
            $this->code = 400;
        }
        return $this;
    }

    // Set custom HTTP/response code
    public function code(int $code): self {
        $this->code = $code;
        return $this;
    }

    // Set response data
    public function data(mixed $data): self {
        $this->data = $data;
        return $this;
    }

    // Set response message
    public function message(string $message): self {
        $this->message = $message;
        return $this;
    }

    // Automatically send headers and JSON string when echoed
    public function __toString(): string {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code($this->code);
        }

        return json_encode([
            'code'    => $this->code,
            'data'    => $this->data,
            'message' => $this->message,
        ], JSON_UNESCAPED_UNICODE);
    }
}