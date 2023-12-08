<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use SQLite3;

class ChatController extends Controller
{
    //
    public function get_history(){
        // Create a new SQLite database connection
        // 'C:\xampp\htdocs\AskBibleChat\storage\app\db.sqlite'
        $db = new SQLite3(storage_path('app/db.sqlite'));

        // Get the user ID from the request data
        $user_id = $_POST['user_id'];
        // Prepare and execute a SELECT statement to retrieve the chat history data
        $stmt = $db->prepare('SELECT human, ai FROM chat_history WHERE user_id = :user_id ORDER BY id ASC');
        $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
        $result = $stmt->execute();

        // Fetch the results and store them in an array
        $chat_history = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $chat_history[] = $row;
        }

        // Close the database connection
        $db->close();

        // Set the HTTP response header to indicate that the response is JSON
        header('Content-Type: application/json');

        // Convert the chat history array to JSON and send it as the HTTP response body
        echo json_encode($chat_history);
    }


    public function deleteChatHistory(){
        // Get the user ID to delete from the request body
        $user_id = $_GET['user'];

        // Create a new SQLite database connection
        $db = new SQLite3(storage_path('app/db.sqlite'));

        // Prepare and execute a DELETE statement to delete chat history records for the specified user ID
        $stmt = $db->prepare('DELETE FROM chat_history WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $user_id, SQLITE3_TEXT);
        $result = $stmt->execute();

        // Close the database connection
        $db->close();

        // Set the HTTP response status code to indicate success
        http_response_code(204); // No Content
    }


    public function send_message(Request $request){
        // $data =  $request->all();
        $id = $_POST['user_id'];
        $msg = $_POST['msg'];


        // Create a new SQLite database connection
        $db = new SQLite3(storage_path('app/db.sqlite'));
        // Prepare the INSERT statement
        $stmt = $db->prepare('INSERT INTO main.chat_history (user_id, human) VALUES (:user_id, :human)');

        // Bind the parameters and execute the statement for each row of data
        $row = ['user_id' => $id, 'human' => $msg];

        $stmt->bindValue(':user_id', $row['user_id']);
        $stmt->bindValue(':human', $row['human']);
        $stmt->execute();


        //
        // Close the database connection
        // Set the HTTP response header to indicate that the response is JSON
        header('$Content-Type: application/json');
        
        // data
        $data = [
            "id" => $db->lastInsertRowID()
        ];

        // Convert the chat history array to JSON and send it as the HTTP response body
        echo json_encode($data);

        $db->close();
    }
    
    public function event_stream(){
        $ROLE = "role";
        $CONTENT = "content";
        $USER = "user";
        $SYS = "system";
        $ASSISTANT = "assistant";

        // $open_ai_key = getenv('OPENAI_API_KEY');
        $open_ai = new OpenAi('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');
        // Open the SQLite database
        $db = new SQLite3(storage_path('app/db.sqlite'));

        $chat_history_id = $_GET['chat_history_id'];
        $id = $_GET['id'];
        
        // Retrieve the data in ascending order by the id column
        $results = $db->query('SELECT * FROM main.chat_history ORDER BY id ASC');
        $history[] = [$ROLE => $SYS, $CONTENT => "You are a helpful assistant."];
        while ($row = $results->fetchArray()) {
            $history[] = [$ROLE => $USER, $CONTENT => $row['human']];
            $history[] = [$ROLE => $ASSISTANT, $CONTENT => $row['ai']];
        }
        // Prepare a SELECT statement to retrieve the 'human' field of the row with ID 6
        $stmt = $db->prepare('SELECT human FROM main.chat_history WHERE id = :id');
        $stmt->bindValue(':id', $chat_history_id, SQLITE3_INTEGER);

        // Execute the SELECT statement and retrieve the 'human' field
        $result = $stmt->execute();
        $msg = $result->fetchArray(SQLITE3_ASSOC)['human'];

        $history[] = [$ROLE => $USER, $CONTENT => $msg];

        $opts = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $history,
            'temperature' => 1.0,
            'max_tokens' => 100,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
            'stream' => true
        ];

        header('Content-type: text/event-stream');
        header('Cache-Control: no-cache');
        $txt = "";
        $complete = $open_ai->chat($opts, function ($curl_info, $data) use (&$txt) {
            if ($obj = json_decode($data) and $obj->error->message != "") {
                error_log(json_encode($obj->error->message));
            } else {
                echo $data;
                $clean = str_replace("data: ", "", $data);
                $arr = json_decode($clean, true);
                if ($data != "data: [DONE]\n\n" and isset($arr["choices"][0]["delta"]["content"])) {
                    $txt .= $arr["choices"][0]["delta"]["content"];
                }
            }

            echo PHP_EOL;
            ob_flush();
            flush();
            return strlen($data);
        });


        // Prepare the UPDATE statement
        $stmt = $db->prepare('UPDATE main.chat_history SET ai = :ai WHERE id = :id');
        $row = ['id' => $chat_history_id, 'ai' => $txt];
        // Bind the parameters and execute the statement
        $stmt->bindValue(':id', $row['id']);
        $stmt->bindValue(':ai', $row['ai']);
        $stmt->execute();

        //
        // Close the database connection
        $db->close();
    }

    
}
