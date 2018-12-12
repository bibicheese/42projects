/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_boolean.h                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/19 00:44:27 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/20 10:27:54 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_BOOLEAN_H
# define FT_BOOLEAN_H

# include <unistd.h>
# define TRUE			1
# define FALSE			0
# define SUCCESS		0
# define EVEN(x)		(x % 2 == 0)
# define EVEN_MSG		"I have an even number of arguments.\n"
# define ODD_MSG		"I have an odd number of arguments.\n"

typedef	int		t_bool;

#endif
