<?php

namespace app\models\services;


use app\models\UserAuthor;

class GuestService
{

    public function subscribe($guestId, $authorId)
    {
        $model = $this->getSubscribe($guestId, $authorId);
        if ($model) {
            return false;
        }

        $model = new UserAuthor();
        $model->user_id = $guestId;
        $model->author_id = $authorId;

        return $model->save();
    }

    public function unsubscribe($guestId, $authorId)
    {
        $model = $this->getSubscribe($guestId, $authorId);
        if ($model) {
            return $model->delete();
        }
        return false;
    }


    public function getSubscribe($guestId, $authorId)
    {
        return UserAuthor::findOne(['user_id' => $guestId, 'author_id' => $authorId]);
    }

    public function getSubscribes($guestId)
    {
        return UserAuthor::findAll(['user_id' => $guestId]);

    }

}