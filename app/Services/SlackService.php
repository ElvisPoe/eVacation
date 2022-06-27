<?php

namespace App\Services;

use App\Models\User;

class SlackService {

    const BASE_URL = 'val';
    const AUTH_TOKEN = 'val';
    const RETIRES = 'val';

    public function getClient() {
        // Create client with tokens and retries
    }

    public function fetchUsers() {
        // Fetch the users in the appropriate json
    }

    public function importUsers() {
        // Import the users from the fetched json
    }

}
