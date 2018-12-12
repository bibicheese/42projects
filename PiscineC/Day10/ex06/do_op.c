/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   do_op.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/21 10:23:30 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 10:44:57 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "header.h"

int		do_op(int nb1, int nb2, char operator)
{
	if (operator == '+')
		return (nb1 + nb2);
	if (operator == '-')
		return (nb1 - nb2);
	if (operator == '/')
		return (nb1 / nb2);
	if (operator == '*')
		return (nb1 * nb2);
	if (operator == '%')
		return (nb1 % nb2);
	return (0);
}
