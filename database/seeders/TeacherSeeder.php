<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Lecture;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachersData = [
            'devyani' => User::firstOrCreate(
                ['email' => 'devyani@eduadmin.com'],
                [
                    'name' => 'Devyani Gautam',
                    'password' => 'password',
                    'role' => 'teacher',
                    'is_active' => true,
                    'department' => 'Science',
                    'subject' => 'Physics, Chemistry, Biology',
                    'highest_degree' => 'MSc',
                    'institution' => 'Delhi University',
                    'years_of_experience' => 8,
                ]
            ),
            'tejashvi' => User::firstOrCreate(
                ['email' => 'tejashvi@eduadmin.com'],
                [
                    'name' => 'Tejashvi Phawa',
                    'password' => 'password',
                    'role' => 'teacher',
                    'is_active' => true,
                    'department' => 'Foundation',
                    'subject' => 'Science, Maths',
                    'highest_degree' => 'BSc BEd',
                    'institution' => 'Regional Institute of Education',
                    'years_of_experience' => 5,
                ]
            ),
            'muskan' => User::firstOrCreate(
                ['email' => 'muskan@eduadmin.com'],
                [
                    'name' => 'Muskan',
                    'password' => 'password',
                    'role' => 'teacher',
                    'is_active' => true,
                    'department' => 'Arts',
                    'subject' => 'History, Geography, Pol Sci',
                    'highest_degree' => 'MA',
                    'institution' => 'JNU',
                    'years_of_experience' => 4,
                ]
            ),
        ];

        $batches = [
            // Devyani Gautam's Batches (Class 10, 11, 12 PCB)
            [
                'name' => 'Class 10 Science Pro',
                'subjects' => ['Physics', 'Chemistry', 'Biology'],
                'grade' => 'Class 10',
                'schedule_days' => ['MON', 'WED', 'FRI'],
                'start_time' => '16:00',
                'end_time' => '17:30',
                'student_limit' => 40,
                'is_active' => true,
                'teacher' => 'devyani',
                'meeting_title' => 'Introduction to Light Reflection',
            ],
            [
                'name' => 'Class 11 PCB Target',
                'subjects' => ['Physics', 'Chemistry', 'Biology'],
                'grade' => 'Class 11',
                'schedule_days' => ['TUE', 'THU', 'SAT'],
                'start_time' => '18:00',
                'end_time' => '20:00',
                'student_limit' => 35,
                'is_active' => true,
                'teacher' => 'devyani',
            ],
            [
                'name' => 'Class 12 PCB Boards',
                'subjects' => ['Physics', 'Chemistry', 'Biology'],
                'grade' => 'Class 12',
                'schedule_days' => ['MON', 'WED', 'FRI'],
                'start_time' => '18:00',
                'end_time' => '20:00',
                'student_limit' => 30,
                'is_active' => true,
                'teacher' => 'devyani',
            ],

            // Tejashvi Phawa's Batches (Class 8 to 10)
            [
                'name' => 'Class 8 Foundation',
                'subjects' => ['Mathematics', 'Science'],
                'grade' => 'Class 8',
                'schedule_days' => ['MON', 'WED', 'FRI'],
                'start_time' => '15:00',
                'end_time' => '16:30',
                'student_limit' => 25,
                'is_active' => true,
                'teacher' => 'tejashvi',
            ],
            [
                'name' => 'Class 9 Foundation',
                'subjects' => ['Mathematics', 'Science'],
                'grade' => 'Class 9',
                'schedule_days' => ['TUE', 'THU', 'SAT'],
                'start_time' => '15:00',
                'end_time' => '16:30',
                'student_limit' => 30,
                'is_active' => true,
                'teacher' => 'tejashvi',
            ],
            [
                'name' => 'Class 10 Math Mastery',
                'subjects' => ['Mathematics'],
                'grade' => 'Class 10',
                'schedule_days' => ['TUE', 'THU', 'SAT'],
                'start_time' => '16:30',
                'end_time' => '18:00',
                'student_limit' => 40,
                'is_active' => true,
                'teacher' => 'tejashvi',
            ],

            // Muskan's Batches (Arts)
            [
                'name' => 'Class 11 Arts & Humanities',
                'subjects' => ['History', 'Geography', 'Political Science'],
                'grade' => 'Class 11',
                'schedule_days' => ['MON', 'WED', 'FRI'],
                'start_time' => '14:00',
                'end_time' => '16:00',
                'student_limit' => 20,
                'is_active' => true,
                'teacher' => 'muskan',
            ],
            [
                'name' => 'Class 12 Arts Excellence',
                'subjects' => ['History', 'Geography', 'Political Science'],
                'grade' => 'Class 12',
                'schedule_days' => ['TUE', 'THU', 'SAT'],
                'start_time' => '14:00',
                'end_time' => '16:00',
                'student_limit' => 25,
                'is_active' => true,
                'teacher' => 'muskan',
            ],
        ];

        foreach ($batches as $batchData) {
            $teacherKey = $batchData['teacher'];
            $teacher = $teachersData[$teacherKey];
            
            $subjects = $batchData['subjects'];
            unset($batchData['subjects']);
            unset($batchData['teacher']);
            
            if (isset($batchData['meeting_title'])) {
                $batchData['meeting_link'] = 'https://meet.google.com/abc-defg-hij';
                $batchData['meeting_scheduled_at'] = now()->next('Wednesday')->setTime(10, 0);
            }

            $batch = Batch::create($batchData);

            // Assign teacher to all subjects for this batch
            foreach ($subjects as $subjectName) {
                $batch->subjects()->create([
                    'name' => $subjectName,
                    'teacher_id' => $teacher->id,
                ]);
            }

            // Generate past lectures
            for ($i = 1; $i <= 3; $i++) {
                $lectureDate = now()->subDays($i * 7);
                Lecture::create([
                    'batch_id' => $batch->id,
                    'title' => 'Lecture ' . (4 - $i) . ': Introduction & Basics',
                    'description' => 'Covered chapter ' . (4 - $i) . ' concepts in detail with Q&A.',
                    'video_url' => 'https://youtube.com/watch?v=dQw4w9WgXcQ',
                    'duration' => '01:30',
                ]);
            }
        }
    }
}
