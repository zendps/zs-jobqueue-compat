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
 * @copyright 2023 Zend by Perforce
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use ZendHQ\JobQueue as ZendPhpJQ;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
class ZendJobQueue
{
    // Job types

    /**
     * An HTTP job with a relative URL
     */
    public const TYPE_HTTP_RELATIVE = 0;

    /**
     * An HTTP job with an absolute URL
     */
    public const TYPE_HTTP = 1;

    /**
     * A PHP-backed CLI job
     */
    public const TYPE_CLI_PHP = 2;

    /**
     * A CLI job
     */
    public const TYPE_CLI = 3;

    /**
     * A shell job
     */
    public const TYPE_SHELL = 3;

    /**
     * An HTTP job with a relative URL
     */
    public const JOB_TYPE_HTTP_RELATIVE = 1;

    /**
     * An HTTP job with an absolute URL
     */
    public const JOB_TYPE_HTTP = 2;

    /**
     * A shell-based job
     */
    public const JOB_TYPE_SHELL = 8;

    // Job priorities

    /**
     * A low priority job
     */
    public const PRIORITY_LOW = 0;

    /**
     * A normal priority job
     */
    public const PRIORITY_NORMAL = 1;

    /**
     * A high priority job
     */
    public const PRIORITY_HIGH = 2;

    /**
     * An urgent priority job
     */
    public const PRIORITY_URGENT = 3;

    /**
     * A low priority job
     */
    public const JOB_PRIORITY_LOW = 1;

    /**
     * A normal priority job
     */
    public const JOB_PRIORITY_NORMAL = 2;

    /**
     * A high priority job
     */
    public const JOB_PRIORITY_HIGH = 4;

    /**
     * An urgent priority job
     */
    public const JOB_PRIORITY_URGENT = 8;

    // Job statuses

    /**
     * The job is waiting to be processed
     */
    public const JOB_STATUS_PENDING = 1;

    /**
     * The job is waiting for its predecessor's completion
     */
    public const JOB_STATUS_WAITING_PREDECESSOR = 2;

    /**
     * The job is executing
     */
    public const JOB_STATUS_RUNNING = 4;

    /**
     * Job execution has been completed successfully
     */
    public const JOB_STATUS_COMPLETED = 8;

    /**
     * The job was executed and reported its successful completion status
     */
    public const JOB_STATUS_OK = 16;

    /**
     * The job execution failed
     */
    public const JOB_STATUS_FAILED = 32;

    /**
     * The job was executed but reported failed completion status
     */
    public const JOB_STATUS_LOGICALLY_FAILED = 64;

    /**
     * Job execution timeout
     */
    public const JOB_STATUS_TIMEOUT = 128;

    /**
     * A logically removed job
     */
    public const JOB_STATUS_REMOVED = 256;

    /**
     * The job is scheduled to be executed at some specific time
     */
    public const JOB_STATUS_SCHEDULED = 512;

    /**
     * The job execution is suspended
     */
    public const JOB_STATUS_SUSPENDED = 1024;

    /**
     * The job execution failed on the backend
     */
    public const JOB_STATUS_FAILED_BACKEND = 2048;

    /**
     * The job execution failed due to the target URL being inaccessible
     */
    public const JOB_STATUS_FAILED_URL = 4096;

    /**
     * The job execution failed due to the runtime not matching
     */
    public const JOB_STATUS_FAILED_RUNTIME = 8192;

    /**
     * The job execution failed to start
     */
    public const JOB_STATUS_FAILED_START = 16384;

    /**
     * The job execution failed due to the predecessor job failing
     */
    public const JOB_STATUS_FAILED_PREDECESSOR = 32768;

    /**
     * The job execution failed because it was aborted
     */
    public const JOB_STATUS_FAILED_ABORTED = 65536;

    /**
     * The job is waiting to be processed
     */
    public const STATUS_PENDING = 0;

    /**
     * The job is waiting for its predecessor's completion
     */
    public const STATUS_WAITING_PREDECESSOR = 1;

    /**
     * The job is executing
     */
    public const STATUS_RUNNING = 2;

    /**
     * Job execution has been completed successfully
     */
    public const STATUS_COMPLETED = 3;

    /**
     * The job was executed and reported its successful completion status
     */
    public const STATUS_OK = 4;

    /**
     * The job execution failed
     */
    public const STATUS_FAILED = 5;

    /**
     * The job was executed but reported failed completion status
     */
    public const STATUS_LOGICALLY_FAILED = 6;

    /**
     * Job execution timeout
     */
    public const STATUS_TIMEOUT = 7;

    /**
     * A logically removed job
     */
    public const STATUS_REMOVED = 8;

    /**
     * The job is scheduled to be executed at some specific time
     */
    public const STATUS_SCHEDULED = 9;

    /**
     * The job execution is suspended
     */
    public const STATUS_SUSPENDED = 10;

    /**
     * The job execution failed on the backend
     */
    public const STATUS_FAILED_BACKEND = 11;

    /**
     * The job execution failed due to the target URL being inaccessible
     */
    public const STATUS_FAILED_URL = 12;

    /**
     * The job execution failed due to the runtime not matching
     */
    public const STATUS_FAILED_RUNTIME = 13;

    /**
     * The job execution failed to start
     */
    public const STATUS_FAILED_START = 14;

    /**
     * The job execution failed due to the predecessor job failing
     */
    public const STATUS_FAILED_PREDECESSOR = 15;

    /**
     * The job execution failed because it was aborted
     */
    public const STATUS_FAILED_ABORTED = 16;

    // Sorting options

    /**
     * Disable sorting of result set of getJobsList()
     */
    public const SORT_JOB_NONE = 0;

    /**
     * Disable sorting of result set of getJobsList()
     */
    public const SORT_NONE = 0;

    /**
     * Sort result set of getJobsList() by job id
     */
    public const SORT_BY_ID = 1;

    /**
     * Sort result set of getJobsList() by job type
     */
    public const SORT_BY_TYPE = 2;

    /**
     * Sort result set of getJobsList() by job script name
     */
    public const SORT_BY_SCRIPT = 3;

    /**
     * Sort result set of getJobsList() by application name
     */
    public const SORT_BY_APPLICATION = 4;

    /**
     * Sort result set of getJobsList() by job name
     */
    public const SORT_BY_NAME = 5;

    /**
     * Sort result set of getJobsList() by job priority
     */
    public const SORT_BY_PRIORITY = 6;

    /**
     * Sort result set of getJobsList() by job status
     */
    public const SORT_BY_STATUS = 7;

    /**
     * Sort result set of getJobsList() by job predecessor
     */
    public const SORT_BY_PREDECESSOR = 8;

    /**
     * Sort result set of getJobsList() by job persistence flag
     */
    public const SORT_BY_PERSISTENCE = 9;

    /**
     * Sort result set of getJobsList() by job creation time
     */
    public const SORT_BY_CREATION_TIME = 10;

    /**
     * Sort result set of getJobsList() by job schedule time
     */
    public const SORT_BY_SCHEDULE_TIME = 11;

    /**
     * Sort result set of getJobsList() by job start time
     */
    public const SORT_BY_START_TIME = 12;

    /**
     * Sort result set of getJobsList() by job end time
     */
    public const SORT_BY_END_TIME = 13;

    // Sort direction

    /**
     * Sort result set of getJobsList() in direct order
     */
    public const SORT_ASC = 0;

    /**
     * Sort result set of getJobsList() in reverse order
     */
    public const SORT_DESC = 1;

    // Other constants

    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    public const OK = 0;

    /**
     * Constant to report completion status from the jobs using setCurrentJobStatus()
     */
    public const FAILED = 1;

    private ZendPhpJQ\JobQueue $jobQueue;

    /**
     * Creates a ZendJobQueue object connected to a Job Queue daemon.
     *
     * @param string $binding This value is accepted for backwards compatibility
     *     only; internally, it is ignored. Future scope will use this to
     *     connect to a specific ZendHQ instance once support for that is
     *     available in the ZendHQ JQ PHP API.
     */
    public function __construct(string $binding = '')
    {
        $this->jobQueue = new ZendPhpJQ\JobQueue();
    }

    /**
     * Creates a new URL based job to make the Job Queue Daemon call given $url with given $vars.
     *
     * @param string $url An absolute URL of the script to call.
     * @param array  $vars An associative array of variables which will be
     *     passed to the script. The total data size of this array should not be
     *     greater than the size defined in the zend_jobqueue.max_message_size
     *     directive.
     * @param mixed  $options An associative array of additional options. The
     *     elements of this array can define job priority, predecessor, persistence,
     *     optional name, additional attributes of HTTP request as HTTP headers,
     *     etc.
     *
     *     The following options are supported:
     *
     *     - "name" - Optional job name
     *     - "priority" - Job priority (see corresponding constants)
     *     - "predecessor" - Integer predecessor job id
     *     - "persistent" - Boolean (keep in history forever)
     *     - "schedule_time" - Time when job should be executed
     *     - "schedule" - CRON-like scheduling command
     *     - "http_headers" - Array of additional HTTP headers
     *     - "job_timeout" - The timeout for the job
     *     - "queue_name" - The queue assigned to the job
     *     - "validate_ssl" - Boolean (validate ssl certificate")
     * @param bool   $legacyWorker set this parameter to true if the worker is
     *     running under real Zend Server.
     * @return int A job ID which can be used to retrieve the job status.
     */
    public function createHttpJob(string $url, array $vars, $options, bool $legacyWorker = false)
    {
        $job = new ZendPhpJQ\HTTPJob(
            $url,
            ZendPhpJQ\HTTPJob::HTTP_METHOD_POST,
            $legacyWorker ? ZendPhpJQ\HTTPJob::CONTENT_TYPE_ZEND_SERVER : ZendPhpJQ\HTTPJob::CONTENT_TYPE_URL_ENCODED
        );

        $job->addHeader('User-Agent', 'Zend Server Job Queue');

        if (isset($options['headers'])) {
            foreach ($options['headers'] as $key => $value) {
                $job->addHeader($key, $value);
            }
        }

        foreach ($vars as $key => $value) {
            $job->addBodyParam($key, $value);
        }

        if (isset($options['name'])) {
            $job->setName($options['name']);
        }

        $jobSchedule = null;
        if (isset($options['schedule'])) {
            $jobSchedule = new ZendPhpJQ\RecurringSchedule($options['schedule']);
        } elseif (isset($options['schedule_time'])) {
            $jobSchedule = new ZendPhpJQ\ScheduledTime(
                DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $options['schedule_time'])
            );
        }

        if (isset($options['predecessor']) && ! empty($options['predecessor'])) {
            error_log(
                sprintf(
                    'Job submission with url "%s" provides a "predecessor" option; '
                    . 'predecessors are not supported in ZendHQ JobQueue at this time',
                    $url
                ),
                E_USER_WARNING
            );
        }

        $jobOptions = new ZendPhpJQ\JobOptions(
            $options['priority'] ?? null,
            $options['job_timeout'] ?? null,
            null,
            null,
            $options['persistent'] ?? ZendPhpJQ\JobOptions::PERSIST_OUTPUT_YES,
            $options['validate_ssl'] ?? null
        );

        if (isset($options['queue_name']) && ! empty($options['queue_name'])) {
            $queue = $this->jobQueue->hasQueue($options['queue_name'])
                ? $this->jobQueue->addQueue($options['queue_name'])
                : $this->jobQueue->getQueue($options['queue_name']);
        } else {
            $queue = $this->jobQueue->getDefaultQueue();
        }

        return $queue->scheduleJob($job, $jobSchedule, $jobOptions)->getId();
    }

    /**
     * Retrieves status of previously created job identified by its ID.
     *
     * @param int $jobId A job ID.
     * @return array The array contains status, completion status and output of the job.
     */
    public function getJobStatus(int $jobId)
    {
        $job = $this->getJobById($jobId);
        if ($job === null) {
            return [];
        }

        // TODO: remap job status
        return [
            'status' => $job->getStatus(), // TODO: remap job status
            'output' => $job->getOutput(),
        ];
    }

    /**
     * Decodes an array of input variables passed to the HTTP job.
     *
     * @return array The job variables.
     */
    public static function getCurrentJobParams()
    {
        return $_POST;
    }

    /**
     * Reports job completion status (OK or FAILED) back to the daemon.
     *
     * @param int    $completion The job completion status (OK or FAILED).
     * @param string $message The optional explanation message.
     */
    public static function setCurrentJobStatus(int $completion, string $message = '')
    {
        http_response_code($completion === self::OK ? 200 : 500);
    }

    /**
     * Removes the job from the queue. Makes all dependent jobs fail. If the job
     * is in progress, it will be finished, but dependent jobs will not be
     * started. For non-existing jobs, the function returns false. Finished jobs
     * are removed from the database.
     *
     * @param int $jobId A job ID
     * @return bool The job was removed or not removed.
     */
    public function removeJob(int $jobId)
    {
    }

    /**
     * Restart a previously executed Job and all its followers.
     *
     * @param int $jobId A job ID
     * @return bool If the job was restarted or not restarted.
     */
    public function restartJob(int $jobId)
    {
    }

    /**
     * Checks if the Job Queue is suspended and returns true or false.
     *
     * @return bool A Job Queue status.
     */
    public function isSuspended()
    {
    }

    /**
     * Checks if the Job Queue Daemon is running.
     *
     * @return bool Return true if the Job Queue Deamon is running, otherwise it returns false.
     */
    public static function isJobQueueDaemonRunning()
    {
    }

    /**
     * Suspends the Job Queue so it will accept new jobs, but will not start
     * them. The jobs which were executed during the call to this function will
     * be completed.
     */
    public function suspendQueue()
    {
    }

    /**
     * Resumes the Job Queue so it will schedule and start queued jobs.
     */
    public function resumeQueue()
    {
    }

    /**
     * Returns internal daemon statistics such as up-time, number of complete
     * jobs, number of failed jobs, number of logically failed jobs, number of
     * waiting jobs, number of currently running jobs, etc.
     *
     * @return array Associative array.
     */
    public function getStatistics()
    {
    }

    /**
     * See getStatistics API. Only checks jobs whose status were changed in a given timespan (seconds).
     *
     * @param int $timeSpan The time span in seconds.
     * @return array Associative array.
     */
    public function getStatisticsByTimespan(int $timeSpan)
    {
    }

    /**
     * Returns the current value of the configuration option of the Job Queue Daemon.
     */
    public function getConfig()
    {
    }

    /**
     * Returns the list of available queues.
     *
     * @return array
     */
    public function getQueues()
    {
        return $this->jobQueue->getQueues();
    }

    /**
     * Re-reads the configuration file of the Job Queue Daemon, and reloads all directives that are reloadable.
     */
    public function reloadConfig()
    {
    }

    /**
     * Returns an associative array with properties of the job with the given id from the daemon database
     *
     * @param int $jobId A job identifier
     * @return array Array of job details. The following properties are provided
     *     (some of them don't have to always be set):
     *     - "id" : The job identifier
     *     - "type" : The job type (see self::TYPE_* constants)
     *     - "status" : The job status (see self::STATUS_* constants)
     *     - "priority" : The job priority (see self::PRIORITY_* constants)
     *     - "persistent" : The persistence flag
     *     - "script" : The URL or SHELL script name
     *     - "predecessor" : The job predecessor
     *     - "name" : The job name
     *     - "vars" : The input variables or arguments
     *     - "http_headers" : The additional HTTP headers for HTTP jobs
     *     - "output" : The output of the job
     *     - "error" : The error output of the job
     *     - "creation_time" : The time when the job was created
     *     - "start_time" : The time when the job was started
     *     - "end_time" : The time when the job was finished
     *     - "schedule" : The CRON-like schedule command
     *     - "schedule_time" : The time when the job execution was scheduled
     *     - "app_id" : The application name
     * @since Zend Server 5.0
     */
    public function getJobInfo(int $jobId)
    {
        $job = $this->getJobById($jobId);
        if ($job === null) {
            return [];
        }

        return [
            'id'         => $job->getId(),
            'name'       => $job->getJobDefinition()->getName(),
            'type'       => '', // The job type (see self::TYPE_* constants)
            'status'     => $job->getStatus(),
            'priority'   => $job->getJobOptions()->getPriority(),
            'persistent' => $job->getJobOptions()->getPersistOutput(),
            // "script" : The URL or SHELL script name
            // "predecessor" : The job predecessor
            'output'        => $job->getOutput(),
            'creation_time' => $job->getCreationTime(),
            'start_time'    => $job->getScheduledTime(),
            'end_time'      => $job->getCompletionTime(),
            // "vars" : The input variables or arguments
            // "http_headers" : The additional HTTP headers for HTTP jobs
            // "error" : The error output of the job
            'schedule'      => $job->getSchedule(),
            'schedule_time' => $job->getScheduledTime()->format('Y-m-d H:i:s'),
            // "app_id" : The application name
        ];
    }

    /**
     * Returns a list of associative arrays with the properties of the jobs
     * which depend on the job with the given identifier.
     */
    public function getDependentJobs()
    {
    }

    /**
     * Returns a list of associative arrays with properties of jobs which conform to a given query
     *
     * @param array    $filter An associative array with query arguments.
     *     The array may contain the following keys which restrict the resulting list:
     *     - "app_id" : Query only jobs which belong to the given application
     *     - "name" : Query only jobs with the given name
     *     - "script" : Query only jobs with a script name similar to the given one (SQL LIKE)
     *     - "type" : Query only jobs of the given types (bitset)
     *     - "priority" : Query only jobs with the given priorities (bitset)
     *     - "status" : Query only jobs with the given statuses (bitset)
     *     - "rule_id" : Query only jobs produced by the given scheduling rule
     *     - "scheduled_before" : Query only jobs scheduled before the given date
     *     - "scheduled_after" : Query only jobs scheduled after the given date
     *     - "executed_before" : Query only jobs executed before the given date
     *     - "executed_after" : Query only jobs executed after the given date
     *     - "sort_by" : Sort by the given field (see self::SORT_BY_* constants)
     *     - "sort_direction" : Sort the order (self::SORT_ASC or self::SORT_DESC)
     *     - "start" : Skip the given number of jobs
     *     - "count" : Retrieve only the given number of jobs (100 by default)
     * @param null|int $total The output parameter which is set to the total
     *     number of jobs conforming to the given query, ignoring "start" and
     *     "count" fields
     * @return array A list of jobs with their details
     */
    public function getJobsList(array $filter = [], $total = null)
    {
        $results = [];
        foreach ($this->getQueues() as $queue) {
            if (isset($filter['name'])) {
                $results = array_merge($results, $queue->getJobsByName($filter['name']));
                continue;
            }

            $results[] = $queue->getJobs();
        }

        foreach ($results as $idx => $job) {
            if (isset($filter['status']) && ($job->getStatus() !== $filter['status'])) {
                unset($results[$idx]);
                continue;
            }

            // TODO: add other filtering parameters...
        }

        return $results;
    }

    /**
     * Returns an array of application names known by the daemon.
     */
    public function getApplications()
    {
    }

    /**
     * Returns an array of all the registered scheduled rules. Each rule is
     * represented by a nested associative array with the following properties:
     *
     * - "id" - The scheduling rule identifier
     * - "status" - The rule status (see STATUS_* constants)
     * - "type" - The rule type (see TYPE_* constants)
     * - "priority" - The priority of the jobs created by this rule
     * - "persistent" - The persistence flag of the jobs created by this rule
     * - "script" - The URL or script to run
     * - "name" - The name of the jobs created by this rule
     * - "vars" - The input variables or arguments
     * - "http_headers" - The additional HTTP headers
     * - "schedule" - The CRON-like schedule command
     * - "app_id" - The application name associated with this rule and created jobs
     * - "last_run" - The last time the rule was run
     * - "next_run" - The next time the rule will run
     *
     * @return array
     */
    public function getSchedulingRules()
    {
    }

    /**
     * Returns an associative array with the properties of the scheduling rule
     * identified by the given argument. The list of the properties is the same
     * as in getSchedulingRules().
     */
    public function getSchedulingRule()
    {
    }

    /**
     * Deletes the scheduling rule identified by the given $rule_id and
     * scheduled jobs created by this rule.
     */
    public function deleteSchedulingRule()
    {
    }

    /**
     * Suspends the scheduling rule identified by given $rule_id and deletes
     * scheduled jobs created by this rule.
     */
    public function suspendSchedulingRule()
    {
    }

    /**
     * Resumes the scheduling rule identified by given $rule_id and creates a
     * corresponding scheduled job.
     */
    public function resumeSchedulingRule()
    {
    }

    /**
     * Updates and reschedules the existing scheduling rule.
     */
    public function updateSchedulingRule()
    {
    }

    /**
     * Returns the current job ID. Returns NULL if not called within a job context.
     */
    public static function getCurrentJobId()
    {
    }

    /**
     * Get Job By Id
     *
     * @return ZendPhpJQ\Job|null
     */
    private function getJobById(int $jobId)
    {
        foreach ($this->getQueues() as $queue) {
            try {
                return $queue->getJob($jobId);
            } catch (ZendPhpJQ\InvalidArgument $ex) {
            }
        }

        return null;
    }
}
