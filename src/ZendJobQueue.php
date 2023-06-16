<?php

/**
 * Zend Job Queue Polyfill
 *
 * In ZendPHP the Job Queue API has changed in comparison to Zend Server Job Queue API.
 * This is a compatibility layer which allows applications running under ZendPHP to
 * use the old Zend Server Job Queue API.
 *
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Slavey Karadzhov <skaradzhov@perforce.com>
 * @copyright 2023 Zend by Perforce
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use ZendHQ\JobQueue as ZendPhpJQ;

if(!class_exists('ZendJobQueue')) {

class ZendJobQueue
{
    /**
     * A HTTP type of job with an absolute URL
     */
    const TYPE_HTTP_RELATIVE = 0;
    /**
     * A HTTP type of job with a relative URL
     */
    const TYPE_HTTP = 1;
    /**
     * A SHELL type of job
     */
    const TYPE_SHELL = 2;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_TYPE_HTTP_RELATIVE = 1;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_TYPE_HTTP = 2;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_TYPE_SHELL = 4;
    /**
     * A low priority job
     */
    const PRIORITY_LOW = 0;
    /**
     * A normal priority job
     */
    const PRIORITY_NORMAL = 1;
    /**
     * A high priority job
     */
    const PRIORITY_HIGH = 2;
    /**
     * An urgent priority job
     */
    const PRIORITY_URGENT = 3;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_PRIORITY_LOW = 1;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_PRIORITY_NORMAL = 2;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_PRIORITY_HIGH = 4;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_PRIORITY_URGENT = 8;
    /**
     * The job is waiting to be processed
     */
    const STATUS_PENDING = 0;
    /**
     * The job is waiting for its predecessor's completion
     */
    const STATUS_WAITING_PREDECESSOR = 1;
    /**
     * The job is executing
     */
    const STATUS_RUNNING = 2;
    /**
     * Job execution has been completed successfully
     */
    const STATUS_COMPLETED = 3;
    /**
     * The job was executed and reported its successful completion status
     */
    const STATUS_OK = 4;
    /**
     * The job execution failed
     */
    const STATUS_FAILED = 5;
    /**
     * The job was executed but reported failed completion status
     */
    const STATUS_LOGICALLY_FAILED = 6;
    /**
     * Job execution timeout
     */
    const STATUS_TIMEOUT = 7;
    /**
     * A logically removed job
     */
    const STATUS_REMOVED = 8;
    /**
     * The job is scheduled to be executed at some specific time
     */
    const STATUS_SCHEDULED = 9;
    /**
     * The job execution is suspended
     */
    const STATUS_SUSPENDED = 10;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_PENDING = 1;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_WAITING_PREDECESSOR = 2;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_RUNNING = 4;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_COMPLETED = 8;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_OK = 16;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_FAILED = 32;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_LOGICALLY_FAILED = 64;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_TIMEOUT = 128;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_REMOVED = 256;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_SCHEDULED = 512;
    /**
     * (No doc, exported with reflection API)
     */
    const JOB_STATUS_SUSPENDED = 1024;
    /**
     * Disable sorting of result set of getJobsList()
     */
    const SORT_NONE = 0;
    /**
     * Sort result set of getJobsList() by job id
     */
    const SORT_BY_ID = 1;
    /**
     * Sort result set of getJobsList() by job type
     */
    const SORT_BY_TYPE = 2;
    /**
     * Sort result set of getJobsList() by job script name
     */
    const SORT_BY_SCRIPT = 3;
    /**
     * Sort result set of getJobsList() by application name
     */
    const SORT_BY_APPLICATION = 4;
    /**
     * Sort result set of getJobsList() by job name
     */
    const SORT_BY_NAME = 5;
    /**
     * Sort result set of getJobsList() by job priority
     */
    const SORT_BY_PRIORITY = 6;
    /**
     * Sort result set of getJobsList() by job status
     */
    const SORT_BY_STATUS = 7;
    /**
     * Sort result set of getJobsList() by job predecessor
     */
    const SORT_BY_PREDECESSOR = 8;
    /**
     * Sort result set of getJobsList() by job persistence flag
     */
    const SORT_BY_PERSISTENCE = 9;
    /**
     * Sort result set of getJobsList() by job creation time
     */
    const SORT_BY_CREATION_TIME = 10;
    /**
     * Sort result set of getJobsList() by job schedule time
     */
    const SORT_BY_SCHEDULE_TIME = 11;
    /**
     * Sort result set of getJobsList() by job start time
     */
    const SORT_BY_START_TIME = 12;
    /**
     * Sort result set of getJobsList() by job end time
     */
    const SORT_BY_END_TIME = 13;
    /**
     * Sort result set of getJobsList() in direct order
     */
    const SORT_ASC = 0;
    /**
     * Sort result set of getJobsList() in reverse order
     */
    const SORT_DESC = 1;
    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    const OK = 0;
    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    const FAILED = 1;

    private $binding;

    /**
     * @var ZendPhpJQ\JobQueue
     */
    private $jobQueue;

    /**
     * Creates a ZendJobQueue object connected to a Job Queue daemon.
     *
     * @param string $binding
     */
    public function __construct(string $binding = '')
    {
        $this->binding = $binding;
        $this->jobQueue = new ZendPhpJQ\JobQueue();
    }

    /**
     * Creates a new URL based job to make the Job Queue Daemon call given $url with given $vars.
     *
     *
     * @param string $url An absolute URL of the script to call.
     * @param array $vars An associative array of variables which will be passed to the script. The total data size of this array should not be greater than the size defined in the zend_jobqueue.max_message_size directive.
     * @param mixed $options An associative array of additional options. The elements of this array can define job priority, predecessor, persistence, optional name, additional attributes of HTTP request as HTTP headers, etc.
     *               The following options are supported:
     *               - "name" - Optional job name
     *               - "priority" - Job priority (see corresponding constants)
     *               - "predecessor" - Integer predecessor job id
     *               - "persistent" - Boolean (keep in history forever)
     *               - "schedule_time" - Time when job should be executed
     *               - "schedule" - CRON-like scheduling command
     *               - "http_headers" - Array of additional HTTP headers
     *               - "job_timeout" - The timeout for the job
     *               - "queue_name" - The queue assigned to the job
     *               - "validate_ssl" - Boolean (validate ssl certificate")
     * @param bool $legacyWorker set this parameter to true if the worker is running under real Zend Server.
     *
     * @return int A job ID which can be used to retrieve the job status.
     */
    public function createHttpJob(string $url, array $vars, $options, bool $legacyWorker = false)
    {
        $job = new ZendPhpJQ\HTTPJob(
                $url,
                ZendPhpJQ\HTTPJob::HTTP_METHOD_POST,
                $legacyWorker ? ZendPhpJQ\HTTPJob::CONTENT_TYPE_ZEND_SERVER: ZendPhpJQ\HTTPJob::CONTENT_TYPE_URL_ENCODED
        );
        $job->addHeader('User-Agent', 'Zend Server Job Queue') ;
        if(isset($options['headers'])) {
            foreach ($options['headers'] as $key => $value) {
                $job->addHeader($key, $value) ;
            }
        }
        foreach ($vars as $key => $value) {
            $job->addBodyParam($key, $value);
        }

        if (isset($options['name'])) {
            $job->setName($options['name']);
        }
        $jobSchedule = null;
        if(isset($options['schedule'])) {
            $jobSchedule = new ZendPhpJQ\RecurringSchedule($options['schedule']);
        }
        else if(isset($options['schedule_time'])) {
            $jobSchedule = new DateTime::createFromFormat('Y-m-d H:i:s', $options['schedule']);
        }

        $jobOptions = new ZendPhpJQ\JobOptions(
            $options['priority'] ?? null,
            $options['job_timeout'] ?? null,
            null,
            null,
            $options['persistent'] ?? ZendPhpJQ\JobOptions::PERSIST_OUTPUT_YES,
            $options['validate_ssl'] ?? null
        );
        // TODO: the following options are not supported: `queue_name` and `predecessor`
        $job = $this->jobQueue->getDefaultQueue()->scheduleJob($job, $jobSchedule, $jobOptions);
        return $this->jobQueue->getDefaultQueue()->getId($job);
    }

    /**
     * Retrieves status of previously created job identified by its ID.
     *
     * @param int $jobId A job ID.
     * @return array The array contains status, completion status and output of the job.
     */
    public function getJobStatus(int $jobId)
    {
        $status = $this->jobQueue->getDefaultQueue()->getStatus($jobId);
        // TODO: remap job status
        return [
            'status' => $status,
            'output' => $this->jobQueue->getDefaultQueue()->getOutput($jobId)
        ];
    }

    /**
     * Decodes an array of input variables passed to the HTTP job.
     *
     * @return array The job variables.
     */
    public function getCurrentJobParams()
    {
        return $_POST;
    }

    /**
     * Reports job completion status (OK or FAILED) back to the daemon.
     *
     * @param int completion The job completion status (OK or FAILED).
     * @param string $message The optional explanation message.
     *
     * @return void
     */
    public function setCurrentJobStatus(int $completion, string $message = '')
    {
        // TODO:
    }

    /**
     * Removes the job from the queue. Makes all dependent jobs fail. If the job is in progress, it will be finished, but dependent jobs will not be started. For non-existing jobs, the function returns false. Finished jobs are removed from the database.
     *
     * @param int $jobId A job ID
     * @return boolean The job was removed or not removed.
     */
    public function removeJob(int $jobId)
    {

    }

    /**
     *
     * Restart a previously executed Job and all its followers.
     *
     * @param int $jobId A job ID
     * @return boolean - If the job was restarted or not restarted.
     */
    public function restartJob(int $jobId)
    {

    }

    /**
     * Checks if the Job Queue is suspended and returns true or false.
     *
     * @return boolean A Job Queue status.
     */
    public function isSuspended()
    {

    }

    /**
     * Checks if the Job Queue Daemon is running.
     *
     * @return boolean Return true if the Job Queue Deamon is running, otherwise it returns false.
     */
    public function isJobQueueDaemonRunning()
    {

    }

    /**
     * Suspends the Job Queue so it will accept new jobs, but will not start them. The jobs which were executed during the call to this function will be completed.
     *
     * @return void
     */
    public function suspendQueue()
    {

    }

    /**
     * Resumes the Job Queue so it will schedule and start queued jobs.
     *
     * @return void
     */
    public function resumeQueue()
    {

    }

    /**
     * Returns internal daemon statistics such as up-time, number of complete jobs, number of failed jobs, number of logically failed jobs, number of waiting jobs, number of currently running jobs, etc.
     *
     * @return array Associative array.
     */
    public function getStatistics()
    {

    }

    /**
     * See getStatistics API. Only checks jobs whose status were changed in a given timespan (seconds).
     *
     * @param int timeSpan The time span in seconds.
     * @return array Associative array.
     */
    public function getStatisticsByTimespan(int $timeSpan)
    {

    }

    /**
     * Returns the current value of the configuration option of the Job Queue Daemon.
     *
     * @return void
     */
    public function getConfig()
    {

    }

    /**
     * Returns the list of available queues.
     *
     * @return void
     */
    public function getQueues()
    {

    }

    /**
     * Re-reads the configuration file of the Job Queue Daemon, and reloads all directives that are reloadable.
     *
     * @return void
     */
    public function reloadConfig()
    {

    }

    /**
     * Returns an associative array with properties of the job with the given ID from the daemon database.
     *
     * @return void
     */
    public function getJobInfo()
    {

    }

    /**
     * Returns a list of associative arrays with the properties of the jobs which depend on the job with the given identifier.
     *
     * @return void
     */
    public function getDependentJobs()
    {

    }

    /**
     * Returns a list of associative arrays with properties of jobs which conform to a given query.
     *
     * @return void
     */
    public function getJobsList()
    {

    }

    /**
     * Returns an array of application names known by the daemon.
     *
     * @return void
     */
    public function getApplications()
    {

    }

    /**
     * Returns an array of all the registered scheduled rules. Each rule is represented by a nested associative array with the following properties:
     *   "id" - The scheduling rule identifier
     *   "status" - The rule status (see STATUS_* constants)
     *   "type" - The rule type (see TYPE_* constants)
     *   "priority" - The priority of the jobs created by this rule
     *   "persistent" - The persistence flag of the jobs created by this rule
     *   "script" - The URL or script to run
     *   "name" - The name of the jobs created by this rule
     *   "vars" - The input variables or arguments
     *   "http_headers" - The additional HTTP headers
     *   "schedule" - The CRON-like schedule command
     *   "app_id" - The application name associated with this rule and created jobs
     *   "last_run" - The last time the rule was run
     *   "next_run" - The next time the rule will run
     *
     * @return array
     */
    public function getSchedulingRules()
    {

    }

    /**
     * Returns an associative array with the properties of the scheduling rule identified by the given argument. The list of the properties is the same as in getSchedulingRules().
     * @return void
     */
    public function getSchedulingRule()
    {

    }

    /**
     * Deletes the scheduling rule identified by the given $rule_id and scheduled jobs created by this rule.
     * @return void
     */
    public function deleteSchedulingRule()
    {

    }

    /**
     * Suspends the scheduling rule identified by given $rule_id and deletes scheduled jobs created by this rule.
     * @return void
     */
    public function suspendSchedulingRule()
    {

    }


    /**
     * Resumes the scheduling rule identified by given $rule_id and creates a corresponding scheduled job.
     * @return void
     */
    public function resumeSchedulingRule()
    {

    }

    /**
     * Updates and reschedules the existing scheduling rule.
     * @return void
     */
    public function updateSchedulingRule()
    {

    }

    /**
     * Returns the current job ID. Returns NULL if not called within a job context.
     * @return void
     */
    public function getCurrentJobId()
    {

    }
}

} // if class exists