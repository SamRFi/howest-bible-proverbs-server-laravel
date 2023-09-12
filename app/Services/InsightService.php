<?php

namespace App\Services;

use App\Models\Insight;

class InsightService extends Service
{
    public function __construct(Insight $model) {
        parent::__construct($model);
    }
    
    protected $_rules = [
        'user_id' => 'required|exists:users,id',
        'chapter_id' => 'required|exists:chapters,id',
        'verse_number' => 'integer|min:1',
        'content' => 'required|string',
    ];
    
    
    public function createInsight($userId, $chapterId, $verseNumber, $content)
    {
        $data = [
            'user_id' => $userId,
            'chapter_id' => $chapterId,
            'verse_number' => $verseNumber,
            'content' => $content,
        ];
    
        $this->validate($data);
    
        if ($this->hasErrors()) {
            return null;
        }
    
        $insight = Insight::create($data);
    
        return $insight;
    }

    public function getInsightsByUser($userId)
    {
        $insights = Insight::with('user', 'chapter')
            ->where('user_id', $userId)
            ->get();

        return $insights;
    }

    public function updateInsightByUser($userId, $insightId, $content)
    {
        $insight = Insight::where('id', $insightId)->where('user_id', $userId)->first();
    
        if (!$insight) {
            return false;
        }
    
        $data = ['content' => $content];
        $rules = ['content' => $this->_rules['content']];
        $this->validate($data, $rules);
    
        if ($this->hasErrors()) {
            return false;
        }
    
        $insight->content = $content;
        $insight->save();
    
        return $insight;
    }


    public function deleteInsightByUser($userId, $insightId)
    {
        $insight = Insight::where('id', $insightId)->where('user_id', $userId)->first();

        if (!$insight) {
            return false;
        }

        $insight->delete();

        return true;
    }   

}
