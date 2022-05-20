<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/compute/v1/compute.proto

namespace Google\Cloud\Compute\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Represents a URL Map resource. Google Compute Engine has two URL Map resources: * [Global](/compute/docs/reference/rest/v1/urlMaps) * [Regional](https://cloud.google.com/compute/docs/reference/rest/v1/regionUrlMaps) A URL map resource is a component of certain types of GCP load balancers and Traffic Director. * urlMaps are used by external HTTP(S) load balancers and Traffic Director. * regionUrlMaps are used by internal HTTP(S) load balancers. For a list of supported URL map features by load balancer type, see the Load balancing features: Routing and traffic management table. For a list of supported URL map features for Traffic Director, see the Traffic Director features: Routing and traffic management table. This resource defines mappings from host names and URL paths to either a backend service or a backend bucket. To use the global urlMaps resource, the backend service must have a loadBalancingScheme of either EXTERNAL or INTERNAL_SELF_MANAGED. To use the regionUrlMaps resource, the backend service must have a loadBalancingScheme of INTERNAL_MANAGED. For more information, read URL Map Concepts.
 *
 * Generated from protobuf message <code>google.cloud.compute.v1.UrlMap</code>
 */
class UrlMap extends \Google\Protobuf\Internal\Message
{
    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>optional string creation_timestamp = 30525366;</code>
     */
    private $creation_timestamp = null;
    /**
     * defaultRouteAction takes effect when none of the hostRules match. The load balancer performs advanced routing actions like URL rewrites, header transformations, etc. prior to forwarding the request to the selected backend. If defaultRouteAction specifies any weightedBackendServices, defaultService must not be set. Conversely if defaultService is set, defaultRouteAction cannot contain any weightedBackendServices. Only one of defaultRouteAction or defaultUrlRedirect must be set. UrlMaps for external HTTP(S) load balancers support only the urlRewrite action within defaultRouteAction. defaultRouteAction has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRouteAction default_route_action = 378919466;</code>
     */
    private $default_route_action = null;
    /**
     * The full or partial URL of the defaultService resource to which traffic is directed if none of the hostRules match. If defaultRouteAction is additionally specified, advanced routing actions like URL Rewrites, etc. take effect prior to sending the request to the backend. However, if defaultService is specified, defaultRouteAction cannot contain any weightedBackendServices. Conversely, if routeAction specifies any weightedBackendServices, service must not be specified. Only one of defaultService, defaultUrlRedirect or defaultRouteAction.weightedBackendService must be set. defaultService has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional string default_service = 370242231;</code>
     */
    private $default_service = null;
    /**
     * When none of the specified hostRules match, the request is redirected to a URL specified by defaultUrlRedirect. If defaultUrlRedirect is specified, defaultService or defaultRouteAction must not be set. Not supported when the URL map is bound to target gRPC proxy.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRedirectAction default_url_redirect = 359503338;</code>
     */
    private $default_url_redirect = null;
    /**
     * An optional description of this resource. Provide this property when you create the resource.
     *
     * Generated from protobuf field <code>optional string description = 422937596;</code>
     */
    private $description = null;
    /**
     * Fingerprint of this resource. A hash of the contents stored in this object. This field is used in optimistic locking. This field will be ignored when inserting a UrlMap. An up-to-date fingerprint must be provided in order to update the UrlMap, otherwise the request will fail with error 412 conditionNotMet. To see the latest fingerprint, make a get() request to retrieve a UrlMap.
     *
     * Generated from protobuf field <code>optional string fingerprint = 234678500;</code>
     */
    private $fingerprint = null;
    /**
     * Specifies changes to request and response headers that need to take effect for the selected backendService. The headerAction specified here take effect after headerAction specified under pathMatcher. Note that headerAction is not supported for Loadbalancers that have their loadBalancingScheme set to EXTERNAL. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpHeaderAction header_action = 328077352;</code>
     */
    private $header_action = null;
    /**
     * The list of HostRules to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.HostRule host_rules = 311804832;</code>
     */
    private $host_rules;
    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>optional uint64 id = 3355;</code>
     */
    private $id = null;
    /**
     * [Output Only] Type of the resource. Always compute#urlMaps for url maps.
     *
     * Generated from protobuf field <code>optional string kind = 3292052;</code>
     */
    private $kind = null;
    /**
     * Name of the resource. Provided by the client when the resource is created. The name must be 1-63 characters long, and comply with RFC1035. Specifically, the name must be 1-63 characters long and match the regular expression `[a-z]([-a-z0-9]*[a-z0-9])?` which means the first character must be a lowercase letter, and all following characters must be a dash, lowercase letter, or digit, except the last character, which cannot be a dash.
     *
     * Generated from protobuf field <code>optional string name = 3373707;</code>
     */
    private $name = null;
    /**
     * The list of named PathMatchers to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.PathMatcher path_matchers = 271664219;</code>
     */
    private $path_matchers;
    /**
     * [Output Only] URL of the region where the regional URL map resides. This field is not applicable to global URL maps. You must specify this field as part of the HTTP request URL. It is not settable as a field in the request body.
     *
     * Generated from protobuf field <code>optional string region = 138946292;</code>
     */
    private $region = null;
    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>optional string self_link = 456214797;</code>
     */
    private $self_link = null;
    /**
     * The list of expected URL mapping tests. Request to update this UrlMap will succeed only if all of the test cases pass. You can specify a maximum of 100 tests per UrlMap. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.UrlMapTest tests = 110251553;</code>
     */
    private $tests;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $creation_timestamp
     *           [Output Only] Creation timestamp in RFC3339 text format.
     *     @type \Google\Cloud\Compute\V1\HttpRouteAction $default_route_action
     *           defaultRouteAction takes effect when none of the hostRules match. The load balancer performs advanced routing actions like URL rewrites, header transformations, etc. prior to forwarding the request to the selected backend. If defaultRouteAction specifies any weightedBackendServices, defaultService must not be set. Conversely if defaultService is set, defaultRouteAction cannot contain any weightedBackendServices. Only one of defaultRouteAction or defaultUrlRedirect must be set. UrlMaps for external HTTP(S) load balancers support only the urlRewrite action within defaultRouteAction. defaultRouteAction has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *     @type string $default_service
     *           The full or partial URL of the defaultService resource to which traffic is directed if none of the hostRules match. If defaultRouteAction is additionally specified, advanced routing actions like URL Rewrites, etc. take effect prior to sending the request to the backend. However, if defaultService is specified, defaultRouteAction cannot contain any weightedBackendServices. Conversely, if routeAction specifies any weightedBackendServices, service must not be specified. Only one of defaultService, defaultUrlRedirect or defaultRouteAction.weightedBackendService must be set. defaultService has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *     @type \Google\Cloud\Compute\V1\HttpRedirectAction $default_url_redirect
     *           When none of the specified hostRules match, the request is redirected to a URL specified by defaultUrlRedirect. If defaultUrlRedirect is specified, defaultService or defaultRouteAction must not be set. Not supported when the URL map is bound to target gRPC proxy.
     *     @type string $description
     *           An optional description of this resource. Provide this property when you create the resource.
     *     @type string $fingerprint
     *           Fingerprint of this resource. A hash of the contents stored in this object. This field is used in optimistic locking. This field will be ignored when inserting a UrlMap. An up-to-date fingerprint must be provided in order to update the UrlMap, otherwise the request will fail with error 412 conditionNotMet. To see the latest fingerprint, make a get() request to retrieve a UrlMap.
     *     @type \Google\Cloud\Compute\V1\HttpHeaderAction $header_action
     *           Specifies changes to request and response headers that need to take effect for the selected backendService. The headerAction specified here take effect after headerAction specified under pathMatcher. Note that headerAction is not supported for Loadbalancers that have their loadBalancingScheme set to EXTERNAL. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *     @type \Google\Cloud\Compute\V1\HostRule[]|\Google\Protobuf\Internal\RepeatedField $host_rules
     *           The list of HostRules to use against the URL.
     *     @type int|string $id
     *           [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *     @type string $kind
     *           [Output Only] Type of the resource. Always compute#urlMaps for url maps.
     *     @type string $name
     *           Name of the resource. Provided by the client when the resource is created. The name must be 1-63 characters long, and comply with RFC1035. Specifically, the name must be 1-63 characters long and match the regular expression `[a-z]([-a-z0-9]*[a-z0-9])?` which means the first character must be a lowercase letter, and all following characters must be a dash, lowercase letter, or digit, except the last character, which cannot be a dash.
     *     @type \Google\Cloud\Compute\V1\PathMatcher[]|\Google\Protobuf\Internal\RepeatedField $path_matchers
     *           The list of named PathMatchers to use against the URL.
     *     @type string $region
     *           [Output Only] URL of the region where the regional URL map resides. This field is not applicable to global URL maps. You must specify this field as part of the HTTP request URL. It is not settable as a field in the request body.
     *     @type string $self_link
     *           [Output Only] Server-defined URL for the resource.
     *     @type \Google\Cloud\Compute\V1\UrlMapTest[]|\Google\Protobuf\Internal\RepeatedField $tests
     *           The list of expected URL mapping tests. Request to update this UrlMap will succeed only if all of the test cases pass. You can specify a maximum of 100 tests per UrlMap. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Compute\V1\Compute::initOnce();
        parent::__construct($data);
    }

    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>optional string creation_timestamp = 30525366;</code>
     * @return string
     */
    public function getCreationTimestamp()
    {
        return isset($this->creation_timestamp) ? $this->creation_timestamp : '';
    }

    public function hasCreationTimestamp()
    {
        return isset($this->creation_timestamp);
    }

    public function clearCreationTimestamp()
    {
        unset($this->creation_timestamp);
    }

    /**
     * [Output Only] Creation timestamp in RFC3339 text format.
     *
     * Generated from protobuf field <code>optional string creation_timestamp = 30525366;</code>
     * @param string $var
     * @return $this
     */
    public function setCreationTimestamp($var)
    {
        GPBUtil::checkString($var, True);
        $this->creation_timestamp = $var;

        return $this;
    }

    /**
     * defaultRouteAction takes effect when none of the hostRules match. The load balancer performs advanced routing actions like URL rewrites, header transformations, etc. prior to forwarding the request to the selected backend. If defaultRouteAction specifies any weightedBackendServices, defaultService must not be set. Conversely if defaultService is set, defaultRouteAction cannot contain any weightedBackendServices. Only one of defaultRouteAction or defaultUrlRedirect must be set. UrlMaps for external HTTP(S) load balancers support only the urlRewrite action within defaultRouteAction. defaultRouteAction has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRouteAction default_route_action = 378919466;</code>
     * @return \Google\Cloud\Compute\V1\HttpRouteAction|null
     */
    public function getDefaultRouteAction()
    {
        return $this->default_route_action;
    }

    public function hasDefaultRouteAction()
    {
        return isset($this->default_route_action);
    }

    public function clearDefaultRouteAction()
    {
        unset($this->default_route_action);
    }

    /**
     * defaultRouteAction takes effect when none of the hostRules match. The load balancer performs advanced routing actions like URL rewrites, header transformations, etc. prior to forwarding the request to the selected backend. If defaultRouteAction specifies any weightedBackendServices, defaultService must not be set. Conversely if defaultService is set, defaultRouteAction cannot contain any weightedBackendServices. Only one of defaultRouteAction or defaultUrlRedirect must be set. UrlMaps for external HTTP(S) load balancers support only the urlRewrite action within defaultRouteAction. defaultRouteAction has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRouteAction default_route_action = 378919466;</code>
     * @param \Google\Cloud\Compute\V1\HttpRouteAction $var
     * @return $this
     */
    public function setDefaultRouteAction($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\HttpRouteAction::class);
        $this->default_route_action = $var;

        return $this;
    }

    /**
     * The full or partial URL of the defaultService resource to which traffic is directed if none of the hostRules match. If defaultRouteAction is additionally specified, advanced routing actions like URL Rewrites, etc. take effect prior to sending the request to the backend. However, if defaultService is specified, defaultRouteAction cannot contain any weightedBackendServices. Conversely, if routeAction specifies any weightedBackendServices, service must not be specified. Only one of defaultService, defaultUrlRedirect or defaultRouteAction.weightedBackendService must be set. defaultService has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional string default_service = 370242231;</code>
     * @return string
     */
    public function getDefaultService()
    {
        return isset($this->default_service) ? $this->default_service : '';
    }

    public function hasDefaultService()
    {
        return isset($this->default_service);
    }

    public function clearDefaultService()
    {
        unset($this->default_service);
    }

    /**
     * The full or partial URL of the defaultService resource to which traffic is directed if none of the hostRules match. If defaultRouteAction is additionally specified, advanced routing actions like URL Rewrites, etc. take effect prior to sending the request to the backend. However, if defaultService is specified, defaultRouteAction cannot contain any weightedBackendServices. Conversely, if routeAction specifies any weightedBackendServices, service must not be specified. Only one of defaultService, defaultUrlRedirect or defaultRouteAction.weightedBackendService must be set. defaultService has no effect when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional string default_service = 370242231;</code>
     * @param string $var
     * @return $this
     */
    public function setDefaultService($var)
    {
        GPBUtil::checkString($var, True);
        $this->default_service = $var;

        return $this;
    }

    /**
     * When none of the specified hostRules match, the request is redirected to a URL specified by defaultUrlRedirect. If defaultUrlRedirect is specified, defaultService or defaultRouteAction must not be set. Not supported when the URL map is bound to target gRPC proxy.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRedirectAction default_url_redirect = 359503338;</code>
     * @return \Google\Cloud\Compute\V1\HttpRedirectAction|null
     */
    public function getDefaultUrlRedirect()
    {
        return $this->default_url_redirect;
    }

    public function hasDefaultUrlRedirect()
    {
        return isset($this->default_url_redirect);
    }

    public function clearDefaultUrlRedirect()
    {
        unset($this->default_url_redirect);
    }

    /**
     * When none of the specified hostRules match, the request is redirected to a URL specified by defaultUrlRedirect. If defaultUrlRedirect is specified, defaultService or defaultRouteAction must not be set. Not supported when the URL map is bound to target gRPC proxy.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpRedirectAction default_url_redirect = 359503338;</code>
     * @param \Google\Cloud\Compute\V1\HttpRedirectAction $var
     * @return $this
     */
    public function setDefaultUrlRedirect($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\HttpRedirectAction::class);
        $this->default_url_redirect = $var;

        return $this;
    }

    /**
     * An optional description of this resource. Provide this property when you create the resource.
     *
     * Generated from protobuf field <code>optional string description = 422937596;</code>
     * @return string
     */
    public function getDescription()
    {
        return isset($this->description) ? $this->description : '';
    }

    public function hasDescription()
    {
        return isset($this->description);
    }

    public function clearDescription()
    {
        unset($this->description);
    }

    /**
     * An optional description of this resource. Provide this property when you create the resource.
     *
     * Generated from protobuf field <code>optional string description = 422937596;</code>
     * @param string $var
     * @return $this
     */
    public function setDescription($var)
    {
        GPBUtil::checkString($var, True);
        $this->description = $var;

        return $this;
    }

    /**
     * Fingerprint of this resource. A hash of the contents stored in this object. This field is used in optimistic locking. This field will be ignored when inserting a UrlMap. An up-to-date fingerprint must be provided in order to update the UrlMap, otherwise the request will fail with error 412 conditionNotMet. To see the latest fingerprint, make a get() request to retrieve a UrlMap.
     *
     * Generated from protobuf field <code>optional string fingerprint = 234678500;</code>
     * @return string
     */
    public function getFingerprint()
    {
        return isset($this->fingerprint) ? $this->fingerprint : '';
    }

    public function hasFingerprint()
    {
        return isset($this->fingerprint);
    }

    public function clearFingerprint()
    {
        unset($this->fingerprint);
    }

    /**
     * Fingerprint of this resource. A hash of the contents stored in this object. This field is used in optimistic locking. This field will be ignored when inserting a UrlMap. An up-to-date fingerprint must be provided in order to update the UrlMap, otherwise the request will fail with error 412 conditionNotMet. To see the latest fingerprint, make a get() request to retrieve a UrlMap.
     *
     * Generated from protobuf field <code>optional string fingerprint = 234678500;</code>
     * @param string $var
     * @return $this
     */
    public function setFingerprint($var)
    {
        GPBUtil::checkString($var, True);
        $this->fingerprint = $var;

        return $this;
    }

    /**
     * Specifies changes to request and response headers that need to take effect for the selected backendService. The headerAction specified here take effect after headerAction specified under pathMatcher. Note that headerAction is not supported for Loadbalancers that have their loadBalancingScheme set to EXTERNAL. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpHeaderAction header_action = 328077352;</code>
     * @return \Google\Cloud\Compute\V1\HttpHeaderAction|null
     */
    public function getHeaderAction()
    {
        return $this->header_action;
    }

    public function hasHeaderAction()
    {
        return isset($this->header_action);
    }

    public function clearHeaderAction()
    {
        unset($this->header_action);
    }

    /**
     * Specifies changes to request and response headers that need to take effect for the selected backendService. The headerAction specified here take effect after headerAction specified under pathMatcher. Note that headerAction is not supported for Loadbalancers that have their loadBalancingScheme set to EXTERNAL. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>optional .google.cloud.compute.v1.HttpHeaderAction header_action = 328077352;</code>
     * @param \Google\Cloud\Compute\V1\HttpHeaderAction $var
     * @return $this
     */
    public function setHeaderAction($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\Compute\V1\HttpHeaderAction::class);
        $this->header_action = $var;

        return $this;
    }

    /**
     * The list of HostRules to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.HostRule host_rules = 311804832;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getHostRules()
    {
        return $this->host_rules;
    }

    /**
     * The list of HostRules to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.HostRule host_rules = 311804832;</code>
     * @param \Google\Cloud\Compute\V1\HostRule[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setHostRules($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Compute\V1\HostRule::class);
        $this->host_rules = $arr;

        return $this;
    }

    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>optional uint64 id = 3355;</code>
     * @return int|string
     */
    public function getId()
    {
        return isset($this->id) ? $this->id : 0;
    }

    public function hasId()
    {
        return isset($this->id);
    }

    public function clearId()
    {
        unset($this->id);
    }

    /**
     * [Output Only] The unique identifier for the resource. This identifier is defined by the server.
     *
     * Generated from protobuf field <code>optional uint64 id = 3355;</code>
     * @param int|string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkUint64($var);
        $this->id = $var;

        return $this;
    }

    /**
     * [Output Only] Type of the resource. Always compute#urlMaps for url maps.
     *
     * Generated from protobuf field <code>optional string kind = 3292052;</code>
     * @return string
     */
    public function getKind()
    {
        return isset($this->kind) ? $this->kind : '';
    }

    public function hasKind()
    {
        return isset($this->kind);
    }

    public function clearKind()
    {
        unset($this->kind);
    }

    /**
     * [Output Only] Type of the resource. Always compute#urlMaps for url maps.
     *
     * Generated from protobuf field <code>optional string kind = 3292052;</code>
     * @param string $var
     * @return $this
     */
    public function setKind($var)
    {
        GPBUtil::checkString($var, True);
        $this->kind = $var;

        return $this;
    }

    /**
     * Name of the resource. Provided by the client when the resource is created. The name must be 1-63 characters long, and comply with RFC1035. Specifically, the name must be 1-63 characters long and match the regular expression `[a-z]([-a-z0-9]*[a-z0-9])?` which means the first character must be a lowercase letter, and all following characters must be a dash, lowercase letter, or digit, except the last character, which cannot be a dash.
     *
     * Generated from protobuf field <code>optional string name = 3373707;</code>
     * @return string
     */
    public function getName()
    {
        return isset($this->name) ? $this->name : '';
    }

    public function hasName()
    {
        return isset($this->name);
    }

    public function clearName()
    {
        unset($this->name);
    }

    /**
     * Name of the resource. Provided by the client when the resource is created. The name must be 1-63 characters long, and comply with RFC1035. Specifically, the name must be 1-63 characters long and match the regular expression `[a-z]([-a-z0-9]*[a-z0-9])?` which means the first character must be a lowercase letter, and all following characters must be a dash, lowercase letter, or digit, except the last character, which cannot be a dash.
     *
     * Generated from protobuf field <code>optional string name = 3373707;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * The list of named PathMatchers to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.PathMatcher path_matchers = 271664219;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPathMatchers()
    {
        return $this->path_matchers;
    }

    /**
     * The list of named PathMatchers to use against the URL.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.PathMatcher path_matchers = 271664219;</code>
     * @param \Google\Cloud\Compute\V1\PathMatcher[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPathMatchers($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Compute\V1\PathMatcher::class);
        $this->path_matchers = $arr;

        return $this;
    }

    /**
     * [Output Only] URL of the region where the regional URL map resides. This field is not applicable to global URL maps. You must specify this field as part of the HTTP request URL. It is not settable as a field in the request body.
     *
     * Generated from protobuf field <code>optional string region = 138946292;</code>
     * @return string
     */
    public function getRegion()
    {
        return isset($this->region) ? $this->region : '';
    }

    public function hasRegion()
    {
        return isset($this->region);
    }

    public function clearRegion()
    {
        unset($this->region);
    }

    /**
     * [Output Only] URL of the region where the regional URL map resides. This field is not applicable to global URL maps. You must specify this field as part of the HTTP request URL. It is not settable as a field in the request body.
     *
     * Generated from protobuf field <code>optional string region = 138946292;</code>
     * @param string $var
     * @return $this
     */
    public function setRegion($var)
    {
        GPBUtil::checkString($var, True);
        $this->region = $var;

        return $this;
    }

    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>optional string self_link = 456214797;</code>
     * @return string
     */
    public function getSelfLink()
    {
        return isset($this->self_link) ? $this->self_link : '';
    }

    public function hasSelfLink()
    {
        return isset($this->self_link);
    }

    public function clearSelfLink()
    {
        unset($this->self_link);
    }

    /**
     * [Output Only] Server-defined URL for the resource.
     *
     * Generated from protobuf field <code>optional string self_link = 456214797;</code>
     * @param string $var
     * @return $this
     */
    public function setSelfLink($var)
    {
        GPBUtil::checkString($var, True);
        $this->self_link = $var;

        return $this;
    }

    /**
     * The list of expected URL mapping tests. Request to update this UrlMap will succeed only if all of the test cases pass. You can specify a maximum of 100 tests per UrlMap. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.UrlMapTest tests = 110251553;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTests()
    {
        return $this->tests;
    }

    /**
     * The list of expected URL mapping tests. Request to update this UrlMap will succeed only if all of the test cases pass. You can specify a maximum of 100 tests per UrlMap. Not supported when the URL map is bound to target gRPC proxy that has validateForProxyless field set to true.
     *
     * Generated from protobuf field <code>repeated .google.cloud.compute.v1.UrlMapTest tests = 110251553;</code>
     * @param \Google\Cloud\Compute\V1\UrlMapTest[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTests($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Compute\V1\UrlMapTest::class);
        $this->tests = $arr;

        return $this;
    }

}

