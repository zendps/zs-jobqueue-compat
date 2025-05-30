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
     * Checks if the Job Queue Daemon is running.
     *
     * @return bool Return true if the Job Queue Deamon is running, otherwise it returns false.
     */
    public static function isJobQueueDaemonRunning()
    {
        try {
            new ZendPhpJQ\JobQueue();
        } catch (ZendPhpJQ\Exception\NetworkError $e) {
            return false;
        } catch (ZendPhpJQ\Exception\LicenseError $e) {
            return false;
        }

        return true;
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
     * @param string $message The optional explanation message; ignored internally
     */
    public static function setCurrentJobStatus(int $completion, string $message = '')
    {
        http_response_code($completion === self::OK ? 200 : 500);
        header('X-Job-Queue-Status: '. $completion);
    }

    /**
     * Returns the current job ID. Returns NULL if not called within a job context.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns null in all cases
     *
     * @return null|int
     */
    public static function getCurrentJobId()
    {
        return null;
    }

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

        if (isset($options['name'])) {
            $job->setName($options['name']);
        }

        $job->addHeader('User-Agent', 'Zend Server Job Queue');

        if (isset($options['headers'])) {
            foreach ($options['headers'] as $key => $value) {
                $job->addHeader($key, $value);
            }
        }

        foreach ($vars as $key => $value) {
            $job->addBodyParam($key, $value);
        }

        return $this->retrieveQueueFromOptions($options)
            ->scheduleJob(
                $job,
                $this->createJobScheduleFromOptions($options),
                $this->createJobOptions($options, $url, true)
            )
            ->getId();
    }

    /**
     * Create a CLI job
     *
     * @param array $options Array of job options, containing any of the following:
     *     - name: optional job name
     *     - priority: job priority
     *     - predecessor: integer predecessor job ID
     *     - persistent: bool flag; keep in history forever
     *     - schedule_time: time when job should be executed
     *     - schedule: cron-like scheduling command
     *     - job_timeout: timeout for the job
     *     - queue_name: queue to which to assign job
     *     - env: array of env vars to assign for script execution
     *     - node_name: string node name where the script should run
     * @return int ID of the generated job
     */
    public function createCliJob(string $command, array $options)
    {
        $job = new ZendPhpJQ\CLIJob($command);

        if (isset($options['name'])) {
            $job->setName($options['name']);
        }

        if (isset($options['env']) && is_array($options['env'])) {
            foreach ($options['env'] as $key => $value) {
                $job->setEnv((string) $key, (string) $value);
            }
        }

        return $this->retrieveQueueFromOptions($options)
            ->scheduleJob(
                $job,
                $this->createJobScheduleFromOptions($options),
                $this->createJobOptions($options, $command, false)
            )
            ->getId();
    }

    /**
     * Create a CLI job to run via the installed PHP interpreter
     *
     * @param array $vars Array of arguments to pass to the script
     * @param array $options Array of job options, containing any of the following:
     *     - name: optional job name
     *     - priority: job priority
     *     - predecessor: integer predecessor job ID
     *     - persistent: bool flag; keep in history forever
     *     - schedule_time: time when job should be executed
     *     - schedule: cron-like scheduling command
     *     - job_timeout: timeout for the job
     *     - queue_name: queue to which to assign job
     *     - env: array of env vars to assign for script execution
     *     - node_name: string node name where the script should run
     * @return int ID of the generated job
     */
    public function createPhpCliJob(string $script, array $vars, array $options)
    {
        $command = sprintf('%s %s', $script, implode(' ', array_map('escapeshellarg', $vars)));
        return $this->createCliJob($command, $options);
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

        return [
            'status' => $this->mapJobStatusToConstant($job),
            'output' => $job->getOutput(),
        ];
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
        foreach ($this->jobQueue->getQueues() as $queue) {
            foreach ($queue->getJobs() as $job) {
                if (! $job->getId() === $jobId) {
                    continue;
                }

                $queue->cancelJob($job);
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the Job Queue is suspended and returns true or false.
     *
     * This method returns true if any single ZendHQ JQ queue is suspended.
     *
     * @return bool A Job Queue status.
     */
    public function isSuspended()
    {
        foreach ($this->jobQueue->getQueues() as $queueName) {
            if ($this->jobQueue->getQueue($queueName)->getStatus() === ZendPhpJQ\Queue::STATUS_SUSPENDED) {
                return true;
            }
        }

        return false;
    }

    /**
     * Suspends the Job Queue so it will accept new jobs, but will not start
     * them. The jobs which were executed during the call to this function will
     * be completed.
     */
    public function suspendQueue()
    {
        foreach ($this->jobQueue->getQueues() as $queueName) {
            $this->jobQueue->getQueue($queueName)->suspend();
        }
    }

    /**
     * Resumes the Job Queue so it will schedule and start queued jobs.
     */
    public function resumeQueue()
    {
        foreach ($this->jobQueue->getQueues() as $queueName) {
            $queue = $this->jobQueue->getQueue($queueName);
            if ($queue->getStatus() === ZendPhpJQ\Queue::STATUS_SUSPENDED) {
                $queue->resume();
            }
        }
    }

    /**
     * Restart a suspended job
     *
     * This method returns false in the following situations:
     *
     * - The job is not found
     * - The job was not in a suspended state
     * - The queue in which the job was found was not in a suspended state
     *
     * NOTE: Resuming the job means resuming the queue under ZendHQ.
     */
    public function restartJob(int $jobId): bool
    {
        $job = $this->getJobById($jobId);
        if (null === $job) {
            return false;
        }

        if ($job->getStatus() !== ZendPhpJQ\Job::STATUS_SUSPENDED) {
            return false;
        }

        $queue = $this->jobQueue->getQueue($job->getQueueName());
        if (! $queue->getStatus() === ZendPhpJQ\Queue::STATUS_SUSPENDED) {
            return false;
        }

        $queue->resume();

        return true;
    }

    /**
     * Returns internal daemon statistics such as up-time, number of complete
     * jobs, number of failed jobs, number of logically failed jobs, number of
     * waiting jobs, number of currently running jobs, etc.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array Associative array.
     */
    public function getStatistics()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
    }

    /**
     * See getStatistics API. Only checks jobs whose status were changed in a given timespan (seconds).
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @param int $timeSpan The time span in seconds.
     * @return array Associative array.
     */
    public function getStatisticsByTimespan(int $timeSpan)
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
    }

    /**
     * Returns the current value of the configuration option of the Job Queue Daemon.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array
     */
    public function getConfig()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
    }

    /**
     * Returns the list of available queues.
     *
     * @return array
     * @psalm-return array<string, array{
     *     id: int,
     *     name: string,
     *     priority: int,
     *     status: int,
     *     max_http_jobs: -1,
     *     max_wait_time: int,
     *     http_connection_timeout: int,
     *     http_job_retry_count: int,
     *     http_job_retry_timeout: int,
     *     running_jobs_count: int,
     *     pending_jobs_count: int,
     * }>
     */
    public function getQueues()
    {
        $queues     = [];
        foreach ($this->jobQueue->getQueues() as $queue) {
            $name = $queue->getName();
            $definition  = $queue->getDefinition();
            $defaults    = $definition->getDefaultJobOptions();
            $timeout     = $defaults->getTimeout();
            $retries     = $defaults->getAllowedRetries();
            $waitTime    = $defaults->getRetryWaitTime();
            $jobs        = $queue->getJobs();
            $runningJobs = array_filter($jobs, function (ZendPhpJQ\Job $job): bool {
                return $job->getStatus() === ZendPhpJQ\Job::STATUS_RUNNING;
            });
            $pendingJobs = array_filter($jobs, function (ZendPhpJQ\Job $job): bool {
                return $job->getStatus() === ZendPhpJQ\Job::STATUS_SCHEDULED;
            });

            $queues[$name] = [
                'id'                      => $queue->getId(),
                'name'                    => $name,
                'priority'                => $this->mapZendHQPriorityToZendServerPriority($definition->getPriority()),
                'status'                  => $this->mapQueueStatusToConstant($queue),
                'max_http_jobs'           => -1,
                'max_wait_time'           => ($timeout * $retries) + (($retries - 1) * $waitTime),
                'http_connection_timeout' => $defaults->getTimeout(),
                'http_job_retry_count'    => $retries,
                'http_job_retry_timeout'  => $waitTime,
                'running_jobs_count'      => count($runningJobs),
                'pending_jobs_count'      => count($pendingJobs),
            ];
        }

        return $queues;
    }

    /**
     * Re-reads the configuration file of the Job Queue Daemon, and reloads all directives that are reloadable.
     *
     * This is a no-op for the polyfill.
     */
    public function reloadConfig()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );
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

        return $this->mapJobToInfoArray($job);
    }

    /**
     * Returns a list of associative arrays with the properties of the jobs
     * which depend on the job with the given identifier.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array
     */
    public function getDependentJobs()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
    }

    /**
     * Returns a list of associative arrays with properties of jobs which conform to a given query
     *
     * @see ZendJobQueue::getJob for details on how each job is presented in the returned list
     *
     * @param array    $filters An associative array with query arguments.
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
    public function getJobsList(array $filters = [], &$total = null)
    {
        $queues = $this->getQueuesBasedOnFilter($filters);
        if (empty($queues)) {
            return [];
        }

        $jobs = $this->retrieveJobsByNameFilter($queues, $filters);
        $jobs = $this->filterJobsByScript($jobs, $filters);
        $jobs = $this->filterJobsByType($jobs, $filters);
        $jobs = $this->filterJobsByPriority($jobs, $filters);
        $jobs = $this->filterJobsByStatus($jobs, $filters);
        $jobs = $this->filterJobsByScheduledBefore($jobs, $filters);
        $jobs = $this->filterJobsByScheduledAfter($jobs, $filters);
        $jobs = $this->filterJobsByExecutedBefore($jobs, $filters);
        $jobs = $this->filterJobsByExecutedAfter($jobs, $filters);

        // Total count before applying start/count filters
        $total = count($jobs);

        // Apply sorting rules
        $jobs = $this->sortJobs($jobs, $filters);

        // Apply slicing
        $jobs = $this->sliceJobs($jobs, $filters);

        // Munge to expected array information
        return array_map(function (ZendPhpJQ\Job $job): array {
            return $this->mapJobToInfoArray($job);
        }, $jobs);
    }

    /**
     * Returns an array of application names known by the daemon.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array
     */
    public function getApplications()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
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
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array
     */
    public function getSchedulingRules()
    {
        $rules = [];
        foreach($this->jobQueue->getDefaultQueue()->getJobs() as $job) {
            if ($job->getStatus() === ZendPhpJQ\Job::STATUS_SCHEDULED) {
                $rules[]=  $this->mapJobToInfoArray($job);
            }
        }

        return $rules;
    }

    /**
     * Returns an associative array with the properties of the scheduling rule
     * identified by the given argument. The list of the properties is the same
     * as in getSchedulingRules().
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns an empty array, and emits an E_USER_WARNING.
     *
     * @return array
     */
    public function getSchedulingRule()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return [];
    }

    /**
     * Deletes the scheduling rule identified by the given $rule_id and
     * scheduled jobs created by this rule.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns false, and emits an E_USER_WARNING.
     *
     * @return boolean
     */
    public function deleteSchedulingRule($jobId)
    {
        try {
            $this->jobQueue->getDefaultQueue()->cancelJob($jobId);
        }
        catch(\Exception $e) {
            // NetworkError - problems communicating with the ZendHQ daemon
            // InvalidException - the $job object is not valid OR no such job
            return false;
        }

        return true;
    }

    /**
     * Suspends the scheduling rule identified by given $rule_id and deletes
     * scheduled jobs created by this rule.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns false, and emits an E_USER_WARNING.
     *
     * @return false
     */
    public function suspendSchedulingRule()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return false;
    }

    /**
     * Resumes the scheduling rule identified by given $rule_id and creates a
     * corresponding scheduled job.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns false, and emits an E_USER_WARNING.
     *
     * @return false
     */
    public function resumeSchedulingRule()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return false;
    }

    /**
     * Updates and reschedules the existing scheduling rule.
     *
     * The ZendHQ implementation does not support this. As such, this method
     * returns false, and emits an E_USER_WARNING.
     *
     * @return false
     */
    public function updateSchedulingRule()
    {
        error_log(
            sprintf('%s is unsupported in the Zend Server ZendJobQueue polyfill', __METHOD__),
            E_USER_WARNING
        );

        return false;
    }

    /**
     * Get Job By Id
     */
    private function getJobById(int $jobId): ?ZendPhpJQ\Job
    {
        foreach ($this->jobQueue->getQueues() as $queue) {
            $jobs = $queue->getJobs();
            foreach ($jobs as $job) {
                if($job->getId() === $jobId) {
                    return $job;
                }
            }
        }

        return null;
    }

    private function createJobOptions(array $options, string $urlOrCommand, bool $isHttpJob):  ZendPhpJQ\JobOptions
    {
        $jobOptions = new ZendPhpJQ\JobOptions(
            $options['priority'] ?? null,
            $options['job_timeout'] ?? null,
            null,
            null,
            $options['persistent'] ?? ZendPhpJQ\JobOptions::PERSIST_OUTPUT_YES,
            $options['validate_ssl'] ?? null
        );

        if (isset($options['predecessor']) && ! empty($options['predecessor'])) {
            error_log(
                sprintf(
                    'Job submission with %s "%s" provides a "predecessor" option; '
                    . 'predecessors are not supported in ZendHQ JobQueue at this time',
                    $isHttpJob ? 'url' : 'command',
                    $urlOrCommand
                ),
                E_USER_WARNING
            );
        }

        if (isset($options['node_name']) && ! empty($options['node_name'])) {
            error_log(
                'Job submission specifying a node_name to run on is not supported in ZendHQ JobQueue at this time',
                E_USER_WARNING
            );
        }

        return $jobOptions;
    }

    private function createJobScheduleFromOptions(array $options): ?ZendPhpJQ\Schedule
    {
        if (isset($options['schedule'])) {
            return new ZendPhpJQ\RecurringSchedule($options['schedule']);
        }

        if (isset($options['schedule_time'])) {
            return new ZendPhpJQ\ScheduledTime(
                DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $options['schedule_time'])
            );
        }

        return null;
    }

    private function retrieveQueueFromOptions(array $options): ZendPhpJQ\Queue
    {
        if (! isset($options['queue_name']) || empty($options['queue_name'])) {
            return $this->jobQueue->getDefaultQueue();
        }

        return $this->jobQueue->hasQueue($options['queue_name'])
            ? $this->jobQueue->addQueue($options['queue_name'])
            : $this->jobQueue->getQueue($options['queue_name']);
    }

    private function mapJobTypeToConstant(ZendPhpJQ\Job $job): int
    {
        if ($job->getJobDefinition() instanceof ZendPhpJQ\HTTPJob) {
            return self::TYPE_HTTP;
        }

        return self::TYPE_CLI;
    }

    private function mapPriorityToConstant(ZendPhpJQ\Job $job): int
    {
        $priority = $job->getJobOptions()->getPriority();
        switch (true) {
            case $priority === ZendPhpJQ\JobOptions::PRIORITY_LOW:
                return self::PRIORITY_LOW;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_NORMAL:
                return self::PRIORITY_NORMAL;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_HIGH:
                return self::PRIORITY_HIGH;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_URGENT:
                return self::PRIORITY_URGENT;
        }
    }

    private function mapPersistenceToBoolean(ZendPhpJQ\Job $job): bool
    {
        $persistOutput = $job->getJobOptions()->getPersistOutput();
        switch (true) {
            case $persistOutput === ZendPhpJQ\JobOptions::PERSIST_OUTPUT_YES:
            case $persistOutput === ZendPhpJQ\JobOptions::PERSIST_OUTPUT_ERROR:
                return true;

            default:
                return false;
        }
    }

    private function mapJobStatusToConstant(ZendPhpJQ\Job $job): int
    {
        $status = $job->getStatus();
        switch (true) {
            case $status === ZendPHPJQ\Job::STATUS_CREATED:
            case $status === ZendPHPJQ\Job::STATUS_SCHEDULED:
                return self::STATUS_PENDING;

            case $status === ZendPHPJQ\Job::STATUS_WAITING_ON_PARENT:
                return self::STATUS_WAITING_PREDECESSOR;

            case $status === ZendPHPJQ\Job::STATUS_RUNNING:
                return self::STATUS_RUNNING;

            case $status === ZendPHPJQ\Job::STATUS_SUSPENDED:
                return self::STATUS_SUSPENDED;

            case $status === ZendPHPJQ\Job::STATUS_TIMEOUT:
                return self::STATUS_TIMEOUT;

            case $status === ZendPHPJQ\Job::STATUS_FAILED_NO_WORKER:
                return self::STATUS_FAILED_BACKEND;

            case $status === ZendPHPJQ\Job::STATUS_FAILED_NO_WORKER:
                return self::STATUS_FAILED_BACKEND;

            case $status === ZendPHPJQ\Job::STATUS_FAILED_WORKER_ERROR:
                return self::STATUS_LOGICALLY_FAILED;

            case $status === ZendPHPJQ\Job::STATUS_REMOVED:
                return self::STATUS_REMOVED;

            case $status === ZendPHPJQ\Job::STATUS_COMPLETED:
                return self::STATUS_COMPLETED;

            default:
                return self::STATUS_FAILED;
        }
    }

    /**
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
     */
    private function mapJobToInfoArray(ZendPHPJQ\Job $job): array
    {
        $jobDefinition = $job->getJobDefinition();

        $info = [
            'id'            => $job->getId(),
            'name'          => $jobDefinition->getName(),
            'type'          => $this->mapJobTypeToConstant($job),
            'status'        => $this->mapJobStatusToConstant($job),
            'priority'      => $this->mapPriorityToConstant($job),
            'persistent'    => $this->mapPersistenceToBoolean($job),
            'script'        => $jobDefinition instanceof ZendPhpJQ\HTTPJob
                ? $jobDefinition->getUrl()
                : $jobDefinition->getCommand(),
            'predecessor'   => null,
            'output'        => $job->getOutput(),
            'creation_time' => $job->getCreationTime()->format('c'),
            'start_time'    => $job->getScheduledTime()->format('c'),
            'end_time'      => $job->getCompletionTime() ? $job->getCompletionTime->format('c') : null,
            'schedule'      => $job->getSchedule(),
            'schedule_time' => $job->getScheduledTime()->format('c'),
            'app_id'        => null,
        ];

        if (null !== $job->getCompletionTime() && ZendPhpJQ\Job::STATUS_COMPLETED !== $job->getStatus()) {
            $info['error'] = $job->getOutput();
        }

        if ($jobDefinition instanceof ZendPhpJQ\CLIJob) {
            $info['vars'] = $jobDefinition->getEnv();
        }

        if ($jobDefinition instanceof ZendPhpJQ\HTTPJob) {
            $info['vars'] = [];
            parse_str($jobDefinition->getBody(), $info['vars']);

            $info['headers'] = $jobDefinition->getHeaders();
        }

        return $info;
    }

    /**
     * Retrieve a list of queues based.
     *
     * If a `queue_name` value is present in the $filters, return an array with
     * that queue (or an empty array if the queue does not exist). Otherwise, return
     * a list of all queues.
     *
     * @return ZendPhpJQ\Queue[]
     */
    private function getQueuesBasedOnFilter(array $filters): array
    {
        if (isset($filters['queue_name']) && is_string($filters['queue_name'])) {
            if (preg_match('/^\s*$/', $filters['queue_name'])) {
                return [];
            }

            if (! $this->jobQueue->hasQueue($filters['queue_name'])) {
                return [];
            }

            return $this->jobQueue->getQueue($filters['queue_name']);
        }

        foreach ($this->jobQueue->getQueues() as $queue) {
            $queues[] = $queue;
        }

        return $queues;
    }

    /**
     * Retrieve jobs from the list of queues based on the name.
     *
     * If $filters does not contain a "name" element, or that value is empty,
     * this will return all jobs for the queues listed.
     *
     * @param ZendPhpJQ\Queue[] $queues
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function retrieveJobsByNameFilter(array $queues, array $filters): array
    {
        $name = $filters['name'] ?? null;
        $jobs = [];
        foreach ($queues as $queue) {
            $jobs = empty($name)
                ? array_merge($jobs, $queue->getJobs())
                : array_merge($jobs, $queue->getJobsByName($name));
        }

        return $jobs;
    }

    /**
     * Filter jobs by "script"
     *
     * If $filters does not contain a "script" element, or that value is empty,
     * this is a no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByScript(array $jobs, array $filters): array
    {
        if (! isset($filters['script']) || ! is_string($filters['script']) || empty($filters['script'])) {
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($filters): bool {
            $jobDefinition = $job->getJobDefinition();
            if ($jobDefinition instanceof ZendPhpJQ\HTTPJob) {
                return false !== stristr($jobDefinition->getUrl(), $filters['script']);
            }

            return false !== stristr($jobDefinition->getCommand(), $filters['script']);
        });
    }

    /**
     * Filter jobs by "type"
     *
     * If $filters does not contain a "type" element, or that value is not an
     * integer, this is a no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByType(array $jobs, array $filters): array
    {
        if (! isset($filters['type']) || ! is_int($filters['type'])) {
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($filters): bool {
            $jobDefinition = $job->getJobDefinition();

            if ($filters['type'] & (self::JOB_TYPE_HTTP_RELATIVE + self::JOB_TYPE_HTTP)) {
                return $jobDefinition instanceof ZendPhpJQ\HTTPJob;
            }

            if ($filters['type'] & self::JOB_TYPE_SHELL) {
                return $jobDefinition instanceof ZendPhpJQ\CLIJob;
            }

            return false;
        });
    }

    /**
     * Filter jobs by "priority"
     *
     * If $filters does not contain a "priority" element, or that value is not an
     * integer, this is a no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByPriority(array $jobs, array $filters): array
    {
        if (! isset($filters['priority']) || ! is_int($filters['priority'])) {
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($filters): bool {
            $priority = $this->mapZendHQPriorityToZendServerPriority($job->getJobOptions()->getPriority());

            return 0 !== $filters['priority'] & $priority;
        });
    }

    private function mapZendHQPriorityToZendServerPriority(int $priority): int
    {
        switch (true) {
            case $priority === ZendPhpJQ\JobOptions::PRIORITY_LOW:
                return self::JOB_PRIORITY_LOW;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_NORMAL:
                return self::JOB_PRIORITY_NORMAL;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_HIGH:
                return self::JOB_PRIORITY_HIGH;

            case $priority === ZendPhpJQ\JobOptions::PRIORITY_URGENT:
                return self::JOB_PRIORITY_URGENT;

            default:
                return self::JOB_PRIORITY_NORMAL;
        }
    }

    /**
     * Filter jobs by "status"
     *
     * If $filters does not contain a "status" element, or that value is not an
     * integer, this is a no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByStatus(array $jobs, array $filters): array
    {
        if (! isset($filters['status']) || ! is_int($filters['status'])) {
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($filters): bool {
            $status = $this->mapJobStatusToConstant($job);

            return 0 !== $filters['status'] & $status;
        });
    }

    /**
     * Filter jobs by "scheduled_before"
     *
     * If $filters does not contain a "scheduled_before" element, or that value
     * can not be converted to a valid DateTimeImmutable instance, this is a
     * no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByScheduledBefore(array $jobs, array $filters): array
    {
        if (
            ! isset($filters['scheduled_before'])
            || (! is_int($filters['scheduled_before']) && ! is_string($filters['scheduled_before']))
        ) {
            return $jobs;
        }

        try {
            $compare = new DateTimeImmutable($filters['scheduled_before']);
        } catch (Exception $e) {
            // Invalid comparison
            error_log(
                'Invalid scheduled_before value provided for getJobsList(); must be valid date-time string',
                E_USER_WARNING
            );
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($compare): bool {
            return $compare > $job->getScheduledTime();
        });
    }

    /**
     * Filter jobs by "scheduled_after"
     *
     * If $filters does not contain a "scheduled_after" element, or that value
     * can not be converted to a valid DateTimeImmutable instance, this is a
     * no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByScheduledAfter(array $jobs, array $filters): array
    {
        if (
            ! isset($filters['scheduled_after'])
            || (! is_int($filters['scheduled_after']) && ! is_string($filters['scheduled_after']))
        ) {
            return $jobs;
        }

        try {
            $compare = new DateTimeImmutable($filters['scheduled_after']);
        } catch (Exception $e) {
            // Invalid comparison
            error_log(
                'Invalid scheduled_after value provided for getJobsList(); must be valid date-time string',
                E_USER_WARNING
            );
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($compare): bool {
            return $compare < $job->getScheduledTime();
        });
    }

    /**
     * Filter jobs by "executed_before"
     *
     * If $filters does not contain a "executed_before" element, or that value
     * can not be converted to a valid DateTimeImmutable instance, this is a
     * no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByExecutedBefore(array $jobs, array $filters): array
    {
        if (
            ! isset($filters['executed_before'])
            || (! is_int($filters['executed_before']) && ! is_string($filters['executed_before']))
        ) {
            return $jobs;
        }

        try {
            $compare = new DateTimeImmutable($filters['executed_before']);
        } catch (Exception $e) {
            // Invalid comparison
            error_log(
                'Invalid executed_before value provided for getJobsList(); must be valid date-time string',
                E_USER_WARNING
            );
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($compare): bool {
            return $compare > $job->getCompletionTime();
        });
    }

    /**
     * Filter jobs by "executed_after"
     *
     * If $filters does not contain a "executed_after" element, or that value
     * can not be converted to a valid DateTimeImmutable instance, this is a
     * no-op.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function filterJobsByExecutedAfter(array $jobs, array $filters): array
    {
        if (
            ! isset($filters['executed_after'])
            || (! is_int($filters['executed_after']) && ! is_string($filters['executed_after']))
        ) {
            return $jobs;
        }

        try {
            $compare = new DateTimeImmutable($filters['executed_after']);
        } catch (Exception $e) {
            // Invalid comparison
            error_log(
                'Invalid executed_after value provided for getJobsList(); must be valid date-time string',
                E_USER_WARNING
            );
            return $jobs;
        }

        return array_filter($jobs, function (ZendPhpJQ\Job $job) use ($compare): bool {
            return $compare < $job->getCompletionTime();
        });
    }

    /**
     * Sort jobs according to specified filters
     *
     * If $filters does not contain a "sort_by" element corresponding to one of
     * the SORT_BY_* constants, this returns the jobs in an unspecified order.
     *
     * The following SORT_BY constants are ignored for purposes of sorting:
     *
     * - SORT_NONE
     * - SORT_JOB_NONE
     * - SORT_BY_APPLICATION
     * - SORT_BY_PREDECESSOR
     *
     * If the "sort_direction" element is not present in $filters, SORT_ASC is
     * assumed.
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function sortJobs(array $jobs, array $filters): array
    {
        if (! isset($filters['sort_by']) || ! is_int($filters['sort_by'])) {
            return $jobs;
        }

        $sortBy = $filters['sort_by'];
        if (
            ! in_array($sortBy, [
                self::SORT_BY_ID,
                self::SORT_BY_TYPE,
                self::SORT_BY_SCRIPT,
                self::SORT_BY_NAME,
                self::SORT_BY_PRIORITY,
                self::SORT_BY_STATUS,
                self::SORT_BY_PERSISTENCE,
                self::SORT_BY_SCHEDULE_TIME,
                self::SORT_BY_START_TIME,
                self::SORT_BY_END_TIME,
            ], true)
        ) {
            return $jobs;
        }

        $sortDirection = $filters['sort_direction'] ?? self::SORT_ASC;
        if (! in_array($sortDirection, [self::SORT_ASC, self::SORT_DESC], true)) {
            $sortDirection = self::SORT_ASC;
        }

        usort($jobs, function (Job $a, Job $b) use ($sortBy, $sortDirection): int {
            $aDefinition = $a->getJobDefinition();
            $bDefinition = $b->getJobDefinition();

            switch (true) {
                case $sortBy === self::SORT_BY_ID:
                    return $sortDirection === self::SORT_ASC
                        ? $a->getId() <=> $b->getId()
                        : $b->getId() <=> $a->getId();

                case $sortBy === self::SORT_BY_TYPE:
                    $aType = $aDefinition === ZendPhpJQ\CLIJob ? self::TYPE_CLI : self::TYPE_HTTP;
                    $bType = $bDefinition === ZendPhpJQ\CLIJob ? self::TYPE_CLI : self::TYPE_HTTP;
                    return $sortDirection === self::SORT_ASC
                        ? $aType <=> $bType
                        : $bType <=> $aType;

                case $sortBy === self::SORT_BY_SCRIPT:
                    $aScript = $aDefinition === ZendPhpJQ\CLIJob ? $aDefinition->getCommand() : $aDefinition->getUrl();
                    $bScript = $bDefinition === ZendPhpJQ\CLIJob ? $bDefinition->getCommand() : $bDefinition->getUrl();
                    return $sortDirection === self::SORT_ASC
                        ? $aScript <=> $bScript
                        : $bScript <=> $aScript;

                case $sortBy === self::SORT_BY_NAME:
                    return $sortDirection === self::SORT_ASC
                        ? $aDefinition->getName() <=> $bDefinition->getName()
                        : $bDefinition->getName() <=> $aDefinition->getName();

                case $sortBy === self::SORT_BY_PRIORITY:
                    $aPriority = $this->mapPriorityToConstant($a);
                    $bPriority = $this->mapPriorityToConstant($b);
                    return $sortDirection === self::SORT_ASC
                        ? $aPriority <=> $bPriority
                        : $bPriority <=> $aPriority;

                case $sortBy === self::SORT_BY_STATUS:
                    $aStatus = $this->mapJobStatusToConstant($a);
                    $bStatus = $this->mapJobStatusToConstant($b);
                    return $sortDirection === self::SORT_ASC
                        ? $aStatus <=> $bStatus
                        : $bStatus <=> $aStatus;

                case $sortBy === self::SORT_BY_PERSISTENCE:
                    return $sortDirection === self::SORT_ASC
                        ? $aDefinition->getPersistOutput() <=> $bDefinition->getPersistOutput()
                        : $bDefinition->getPersistOutput() <=> $aDefinition->getPersistOutput();

                case $sortBy === self::SORT_BY_CREATION_TIME:
                    return $sortDirection === self::SORT_ASC
                        ? $a->getCreationTime() <=> $b->getCreationTime()
                        : $b->getCreationTime() <=> $a->getCreationTime();

                case $sortBy === self::SORT_BY_SCHEDULE_TIME:
                case $sortBy === self::SORT_BY_START_TIME:
                    return $sortDirection === self::SORT_ASC
                        ? $a->getScheduledTime() <=> $b->getScheduledTime()
                        : $b->getScheduledTime() <=> $a->getScheduledTime();

                case $sortBy === self::SORT_BY_END_TIME:
                    return $sortDirection === self::SORT_ASC
                        ? $a->getCompletionTime() <=> $b->getCompletionTime()
                        : $b->getCompletionTime() <=> $a->getCompletionTime();

                default:
                    return $sortDirection === self::SORT_ASC
                        ? $a <=> $b
                        : $b <=> $a;
            }
        });

        return $jobs;
    }

    /**
     * Return a slice of the jobs list based on the filters "start" and/or "count"
     *
     * @param ZendPhpJQ\Job[] $jobs
     * @psalm-param array<string, string> $filters
     * @return ZendPhpJQ\Job[]
     */
    private function sliceJobs(array $jobs, array $filters): array
    {
        $total = count($jobs);
        $start = $filters['start'] ?? 0;
        $start = (int) $start;

        if ($start > $total) {
            return [];
        }

        $count = $filters['count'] ?? null;
        $count = null === $count ? null : (int) $count;

        if ($start === 0 && (null !== $count && $count >= $total)) {
            return $jobs;
        }

        return array_slice($jobs, $start, $count);
    }

    private function mapQueueStatusToConstant(ZendPhpJQ\Queue $queue): int
    {
        $status = $queue->getStatus();
        switch (true) {
            case $status === ZendPhpJQ\Queue::STATUS_SUSPENDED:
                return self::STATUS_SUSPENDED;

            case $status === ZendPhpJQ\Queue::STATUS_DELETED:
                return self::STATUS_REMOVED;

            case $status === ZendPhpJQ\Queue::STATUS_RUNNING:
            default:
                return self::STATUS_RUNNING;
        }
    }
}
