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
    const OK = 1;
    const FAILED = 0;

    const STATUS_OK = 1;

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
     *
     *               "name" - Optional job name
     *               "priority" - Job priority (see corresponding constants)
     *               "predecessor" - Integer predecessor job id
     *               "persistent" - Boolean (keep in history forever)
     *               "schedule_time" - Time when job should be executed
     *               "schedule" - CRON-like scheduling command
     *               "http_headers" - Array of additional HTTP headers
     *               "job_timeout" - The timeout for the job
     *               "queue_name" - The queue assigned to the job
     *               "validate_ssl" - Boolean (validate ssl certificate")
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
        foreach ($vars as $key => $value) {
            $job->addBodyParam($key, $value);
        }
        // process options
        if (isset($options['name'])) {
            $job->setName($options['name']);
        }
        // TODO: finish all options
        $job = $this->jobQueue->getDefaultQueue()->scheduleJob($job);
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